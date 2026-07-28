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
    public ?string $service = 'pulsa'; // Default to pulsa

    public function mount(): void
    {
        $this->service = request()->query('service', 'pulsa');
        $this->form->fill();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_no')
                    ->label('Nomor Tujuan')
                    ->required()
                    ->live(debounce: 500)
                    ->placeholder('081234567890'),
                    
                Forms\Components\Select::make('product_id')
                    ->label('Pilih Produk')
                    ->required()
                    ->searchable()
                    ->options(function (Forms\Get $get) {
                        $phone = $get('customer_no');
                        $brand = null;
                        
                        if ($phone && strlen($phone) >= 4) {
                            $prefix = substr($phone, 0, 4);
                            $telkomsel = ['0811','0812','0813','0821','0822','0823','0852','0853','0851'];
                            $indosat = ['0814','0815','0816','0855','0856','0857','0858'];
                            $xl = ['0817','0818','0819','0859','0877','0878'];
                            $axis = ['0838','0831','0832','0833'];
                            $tri = ['0895','0896','0897','0898','0899'];
                            $smartfren = ['0881','0882','0883','0884','0885','0886','0887','0888','0889'];
                            
                            if (in_array($prefix, $telkomsel)) $brand = 'TELKOMSEL';
                            elseif (in_array($prefix, $indosat)) $brand = 'INDOSAT';
                            elseif (in_array($prefix, $xl)) $brand = 'XL';
                            elseif (in_array($prefix, $axis)) $brand = 'AXIS';
                            elseif (in_array($prefix, $tri)) $brand = 'TRI';
                            elseif (in_array($prefix, $smartfren)) $brand = 'SMARTFREN';
                        }
                        
                        $markup = auth()->user()->markup ?? 500;
                        
                        $query = Product::where('seller_product_status', true);
                        
                        // Map the requested service to Digiflazz categories
                        $service = $this->service;
                        if ($service === 'pulsa') {
                            $query->whereIn('category', ['Pulsa', 'Paket SMS & Telpon', 'Masa Aktif']);
                        } elseif ($service === 'data') {
                            $query->whereIn('category', ['Data', 'Aktivasi Perdana', 'Aktivasi Voucher', 'Voucher']);
                        } elseif ($service === 'pln') {
                            $query->whereIn('category', ['PLN']);
                        } elseif ($service === 'pdam') {
                            $query->whereIn('category', ['PDAM']);
                        }
                                        
                        if ($brand && in_array($service, ['pulsa', 'data'])) {
                            $query->where('brand', $brand);
                        }
                        
                        return $query->get()
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
