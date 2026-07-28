<?php

namespace App\Filament\Member\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Support\Str;
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
        // Determine dynamic label and placeholder
        $customerNoLabel = 'Nomor Tujuan';
        $customerNoPlaceholder = 'Masukkan nomor';
        if (in_array($this->service, ['pulsa', 'data', 'ewallet'])) {
            $customerNoLabel = 'Nomor HP / Akun';
            $customerNoPlaceholder = '081234567890';
        } elseif ($this->service === 'pln' || $this->service === 'pln_pasca') {
            $customerNoLabel = 'No. Meter / ID Pelanggan';
            $customerNoPlaceholder = '123456789012';
        } elseif ($this->service === 'game') {
            $customerNoLabel = 'User ID';
            $customerNoPlaceholder = '12345678';
        } elseif (in_array($this->service, ['pdam', 'bpjs', 'internet', 'hp_pasca'])) {
            $customerNoLabel = 'ID Pelanggan';
            $customerNoPlaceholder = 'Masukkan ID Pelanggan';
        }

        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_no')
                    ->label($customerNoLabel)
                    ->required()
                    ->live(debounce: 500)
                    ->placeholder($customerNoPlaceholder),
                    
                Forms\Components\TextInput::make('zone_id')
                    ->label('Zone ID / Server ID')
                    ->placeholder('Misal: 1234')
                    ->hidden(fn () => $this->service !== 'game'),
                    
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
                        } elseif ($service === 'game') {
                            $query->whereIn('category', ['Games']);
                        } elseif ($service === 'ewallet') {
                            $query->whereIn('category', ['E-Money']); // Adjust if Digiflazz uses different term, usually E-Money or E-Wallet
                        } elseif ($service === 'pdam') {
                            $query->where('category', 'Pascabayar')->where('brand', 'PDAM');
                        } elseif ($service === 'bpjs') {
                            $query->where('category', 'Pascabayar')->where('brand', 'BPJS KESEHATAN');
                        } elseif ($service === 'internet') {
                            $query->where('category', 'Pascabayar')->where('brand', 'INTERNET PASCABAYAR');
                        } elseif ($service === 'hp_pasca') {
                            $query->where('category', 'Pascabayar')->where('brand', 'HP PASCABAYAR');
                        } elseif ($service === 'pln_pasca') {
                            $query->where('category', 'Pascabayar')->where('brand', 'PLN PASCABAYAR');
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
        
        $customerNo = $data['customer_no'];
        
        // For games, concatenate zone_id if provided
        if ($this->service === 'game' && !empty($data['zone_id'])) {
            $customerNo .= $data['zone_id'];
        }

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

            // Save transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'ref_id' => $refId,
                'customer_no' => $customerNo,
                'buyer_sku_code' => $product->buyer_sku_code,
                'message' => 'Pending',
                'status' => 'Pending',
                'sn' => null,
                'rc' => null,
                'amount' => $finalPrice,
            ]);

            DB::commit();

            // Hit Digiflazz
            $username = Setting::where('key', 'digiflazz_username')->value('value');
            $apiKey = Setting::where('key', 'digiflazz_production_key')->value('value');
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
