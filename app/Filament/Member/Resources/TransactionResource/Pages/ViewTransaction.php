<?php

namespace App\Filament\Member\Resources\TransactionResource\Pages;

use App\Filament\Member\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_receipt')
                ->label('Cetak Struk')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn (\App\Models\Transaction $record) => route('receipt.show', ['ref_id' => $record->ref_id]))
                ->openUrlInNewTab(),
                
            Actions\Action::make('check_status')
                ->label('Cek Status')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->visible(fn (\App\Models\Transaction $record) => $record->status === 'Pending')
                ->action(function (\App\Models\Transaction $record) {
                    $username = \App\Models\Setting::where('key', 'digiflazz_username')->value('value');
                    $apiKey = \App\Models\Setting::where('key', 'digiflazz_production_key')->value('value');
                    $signature = md5($username . $apiKey . $record->ref_id);

                    $payload = [
                        'username' => $username,
                        'buyer_sku_code' => $record->buyer_sku_code,
                        'customer_no' => $record->customer_no,
                        'ref_id' => $record->ref_id,
                        'sign' => $signature,
                    ];

                    $product = \App\Models\Product::where('buyer_sku_code', $record->buyer_sku_code)->first();
                    if ($product && strtolower($product->category) === 'pascabayar') {
                        $payload['commands'] = 'status-pasca';
                    }
                    
                    $response = \Illuminate\Support\Facades\Http::timeout(60)->post('https://api.digiflazz.com/v1/transaction', $payload);

                    $result = $response->json();

                    if (isset($result['data'])) {
                        $status = $result['data']['status'];
                        $message = $result['data']['message'];
                        
                        $record->update([
                            'status' => $status,
                            'message' => $message,
                            'sn' => $result['data']['sn'] ?? $record->sn,
                        ]);

                        if ($status === 'Gagal') {
                            $user = $record->user;
                            $user->saldo += $record->amount;
                            $user->save();
                            \Filament\Notifications\Notification::make()->title('Transaksi Gagal, saldo dikembalikan.')->warning()->send();
                        } elseif ($status === 'Sukses') {
                            \Filament\Notifications\Notification::make()->title('Transaksi telah Sukses!')->success()->send();
                        } else {
                            \Filament\Notifications\Notification::make()->title('Transaksi masih Pending')->info()->send();
                        }
                    } else {
                        \Filament\Notifications\Notification::make()->title('Gagal mengecek status')->danger()->send();
                    }
                    
                    // Refresh the view
                    $this->refreshFormData(['status', 'message', 'sn']);
                }),
        ];
    }
}
