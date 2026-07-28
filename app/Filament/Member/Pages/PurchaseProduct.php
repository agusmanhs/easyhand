<?php

namespace App\Filament\Member\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class PurchaseProduct extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Beli Pulsa & Data';
    protected static ?string $title = 'Pembelian Produk';

    protected static string $view = 'filament.member.pages.purchase-product';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_no')
                    ->label('Nomor Tujuan')
                    ->required()
                    ->placeholder('081234567890'),
                    
                Forms\Components\Select::make('product_id')
                    ->label('Pilih Produk')
                    ->required()
                    ->searchable()
                    ->options(function () {
                        $markup = auth()->user()->markup ?? 500;
                        return Product::where('seller_product_status', true)
                            ->get()
                            ->mapWithKeys(function ($p) use ($markup) {
                                $finalPrice = $p->price + $markup;
                                return [$p->id => "{$p->product_name} - Rp " . number_format($finalPrice, 0, ',', '.')];
                            });
                    })
                    ->reactive(),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();
        $user = auth()->user();
        $markup = $user->markup ?? 500;

        $product = Product::find($data['product_id']);
        if (!$product) {
            Notification::make()->title('Produk tidak ditemukan')->danger()->send();
            return;
        }

        $finalPrice = $product->price + $markup;

        if ($user->saldo < $finalPrice) {
            Notification::make()->title('Saldo tidak mencukupi')->danger()->send();
            return;
        }

        DB::beginTransaction();
        try {
            // Deduct balance
            $user->saldo -= $finalPrice;
            $user->save();

            $refId = 'EH-' . time() . '-' . rand(1000, 9999);

            // Create Transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'ref_id' => $refId,
                'customer_no' => $data['customer_no'],
                'buyer_sku_code' => $product->buyer_sku_code,
                'amount' => $finalPrice,
                'status' => 'Pending',
                'message' => 'Transaksi sedang diproses',
            ]);

            DB::commit();

            // Hit Digiflazz
            $username = \App\Models\Setting::where('key', 'digiflazz_username')->value('value');
            $apiKey = \App\Models\Setting::where('key', 'digiflazz_production_key')->value('value');
            $signature = md5($username . $apiKey . $refId);

            $response = Http::post('https://api.digiflazz.com/v1/transaction', [
                'username' => $username,
                'buyer_sku_code' => $product->buyer_sku_code,
                'customer_no' => $data['customer_no'],
                'ref_id' => $refId,
                'sign' => $signature,
                'testing' => true
            ]);

            $result = $response->json();

            if (isset($result['data'])) {
                $status = $result['data']['status']; // Sukses, Gagal, Pending
                $message = $result['data']['message'];
                
                $transaction->update([
                    'status' => $status,
                    'message' => $message,
                    'sn' => $result['data']['sn'] ?? null,
                ]);

                if ($status === 'Gagal') {
                    // Refund
                    $user->saldo += $finalPrice;
                    $user->save();
                    Notification::make()->title('Transaksi Gagal: ' . $message)->warning()->send();
                } else {
                    Notification::make()->title('Transaksi Berhasil Dibuat')->success()->send();
                }
            } else {
                Notification::make()->title('Gagal terhubung ke Digiflazz')->danger()->send();
            }

            return redirect()->to('/member');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()->title('Terjadi kesalahan sistem: ' . $e->getMessage())->danger()->send();
        }
    }
}
