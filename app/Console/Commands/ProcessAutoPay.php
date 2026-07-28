<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessAutoPay extends Command
{
    protected $signature = 'app:process-auto-pay';

    protected $description = 'Process due Auto Pay subscriptions';

    public function handle()
    {
        $now = \Carbon\Carbon::now();
        $dueAutoPays = \App\Models\AutoPay::with(['user', 'product'])
            ->where('status', true)
            ->where('next_run_at', '<=', $now)
            ->get();

        foreach ($dueAutoPays as $autoPay) {
            $user = $autoPay->user;
            $product = $autoPay->product;
            
            if (!$user || !$product) continue;
            
            $markup = $user->markup ?? 500;
            $finalPrice = $product->price + $markup;
            
            // Check balance
            if ($user->saldo < $finalPrice) {
                \Filament\Notifications\Notification::make()
                    ->title('Auto Pay Gagal')
                    ->body("Saldo tidak cukup untuk perpanjangan {$product->product_name} ke {$autoPay->customer_no}.")
                    ->danger()
                    ->sendToDatabase($user);
                    
                // Skip cycle
                $autoPay->next_run_at = \App\Models\AutoPay::calculateNextRunAt($autoPay->schedule_type, $autoPay->schedule_day, $autoPay->schedule_time);
                $autoPay->save();
                continue;
            }
            
            \Illuminate\Support\Facades\DB::beginTransaction();
            try {
                // Deduct balance
                $user->saldo -= $finalPrice;
                $user->save();

                $refId = 'AP-' . time() . '-' . rand(1000, 9999);
                
                $customerNo = $autoPay->customer_no;
                if ($autoPay->zone_id) {
                    $customerNo .= $autoPay->zone_id;
                }

                $transaction = \App\Models\Transaction::create([
                    'user_id' => $user->id,
                    'ref_id' => $refId,
                    'customer_no' => $customerNo,
                    'buyer_sku_code' => $product->buyer_sku_code,
                    'message' => 'Pending (Auto Pay)',
                    'status' => 'Pending',
                    'amount' => $finalPrice,
                ]);

                \Illuminate\Support\Facades\DB::commit();

                // Hit Digiflazz
                $username = \App\Models\Setting::where('key', 'digiflazz_username')->value('value');
                $apiKey = \App\Models\Setting::where('key', 'digiflazz_production_key')->value('value');
                $signature = md5($username . $apiKey . $refId);

                $response = \Illuminate\Support\Facades\Http::post('https://api.digiflazz.com/v1/transaction', [
                    'username' => $username,
                    'buyer_sku_code' => $product->buyer_sku_code,
                    'customer_no' => $customerNo,
                    'ref_id' => $refId,
                    'sign' => $signature,
                ]);
                
                $result = $response->json();
                
                if (isset($result['data'])) {
                    $transaction->update([
                        'status' => $result['data']['status'],
                        'message' => $result['data']['message'],
                        'sn' => $result['data']['sn'] ?? null,
                    ]);
                    
                    if ($result['data']['status'] === 'Gagal') {
                        $user->saldo += $finalPrice;
                        $user->save();
                        \Filament\Notifications\Notification::make()
                            ->title('Auto Pay Dibatalkan')
                            ->body("Trx Gagal: {$result['data']['message']}")
                            ->warning()
                            ->sendToDatabase($user);
                    } else {
                        \Filament\Notifications\Notification::make()
                            ->title('Auto Pay Berhasil')
                            ->body("{$product->product_name} sukses diproses!")
                            ->success()
                            ->sendToDatabase($user);
                    }
                }

                // Update schedule
                $autoPay->last_run_at = $now;
                $autoPay->next_run_at = \App\Models\AutoPay::calculateNextRunAt($autoPay->schedule_type, $autoPay->schedule_day, $autoPay->schedule_time);
                $autoPay->save();

            } catch (\Exception $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                \Illuminate\Support\Facades\Log::error('AutoPay Error: ' . $e->getMessage());
            }
        }
    }
}
