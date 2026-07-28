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
    
    public ?array $inquiryData = null;
    public ?string $inquiryRefId = null;

    public function mount(): void
    {
        $this->service = request()->query('service', 'pulsa');
        $this->form->fill();
    }

    public function isPostpaid(): bool
    {
        return in_array($this->service, ['pdam', 'bpjs', 'internet', 'hp_pasca', 'pln_pasca']);
    }

    public function cancelInquiry(): void
    {
        $this->inquiryData = null;
        $this->inquiryRefId = null;
    }

    public function getAvailableProductsProperty()
    {
        $phone = $this->data['customer_no'] ?? null;
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
            $query->whereIn('category', ['E-Money']); 
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
        
        return $query->get();
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
                    
                Forms\Components\ViewField::make('product_id')
                    ->label('Pilih Produk')
                    ->required()
                    ->view('forms.components.product-grid')
                    ->columnSpanFull()
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
        if ($this->service === 'game' && !empty($data['zone_id'])) {
            $customerNo .= $data['zone_id'];
        }

        $product = Product::find($data['product_id']);
        if (!$product) {
            Notification::make()->title('Produk tidak ditemukan')->danger()->send();
            return;
        }

        if ($this->isPostpaid()) {
            if (!$this->inquiryData) {
                $this->doInquiry($product, $customerNo);
                return;
            } else {
                $this->doPayPostpaid($product, $customerNo, $markup);
                return;
            }
        }

        // --- PREPAID FLOW ---
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

            // Hit Digiflazz for Prepaid
            $username = Setting::where('key', 'digiflazz_username')->value('value');
            $apiKey = Setting::where('key', 'digiflazz_production_key')->value('value');
            $signature = md5($username . $apiKey . $refId);

            $response = Http::post('https://api.digiflazz.com/v1/transaction', [
                'username' => $username,
                'buyer_sku_code' => $product->buyer_sku_code,
                'customer_no' => $customerNo,
                'ref_id' => $refId,
                'sign' => $signature,
            ]);

            $this->handleDigiflazzResponse($response, $transaction, $user, $finalPrice);

            return redirect()->to('/member');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()->title('Terjadi kesalahan sistem: ' . $e->getMessage())->danger()->send();
        }
    }

    private function doInquiry($product, $customerNo)
    {
        $refId = 'INQ-' . time() . '-' . rand(1000, 9999);
        $username = Setting::where('key', 'digiflazz_username')->value('value');
        $apiKey = Setting::where('key', 'digiflazz_production_key')->value('value');
        $signature = md5($username . $apiKey . $refId);

        try {
            $response = Http::post('https://api.digiflazz.com/v1/transaction', [
                'commands' => 'inq-pasca',
                'username' => $username,
                'buyer_sku_code' => $product->buyer_sku_code,
                'customer_no' => $customerNo,
                'ref_id' => $refId,
                'sign' => $signature,
            ]);

            $result = $response->json();

            if (isset($result['data'])) {
                if ($result['data']['status'] === 'Gagal') {
                    Notification::make()->title('Gagal Cek Tagihan')->body($result['data']['message'] ?? 'Tagihan tidak ditemukan')->danger()->send();
                    return;
                }
                $this->inquiryData = $result['data'];
                $this->inquiryRefId = $refId;
                Notification::make()->title('Tagihan Ditemukan')->success()->send();
            } else {
                Notification::make()->title('Gagal terhubung ke server tagihan')->danger()->send();
            }
        } catch (\Exception $e) {
            Notification::make()->title('Kesalahan koneksi: ' . $e->getMessage())->danger()->send();
        }
    }

    private function doPayPostpaid($product, $customerNo, $markup)
    {
        $user = auth()->user();
        $finalPrice = ($this->inquiryData['selling_price'] ?? 0) + $markup;

        if ($user->saldo < $finalPrice) {
            Notification::make()->title('Saldo tidak mencukupi')->danger()->send();
            return;
        }

        DB::beginTransaction();
        try {
            // Deduct balance
            $user->saldo -= $finalPrice;
            $user->save();

            $refId = 'PAY-' . time() . '-' . rand(1000, 9999);

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

            $username = Setting::where('key', 'digiflazz_username')->value('value');
            $apiKey = Setting::where('key', 'digiflazz_production_key')->value('value');
            $signature = md5($username . $apiKey . $refId);

            $response = Http::post('https://api.digiflazz.com/v1/transaction', [
                'commands' => 'pay-pasca',
                'username' => $username,
                'buyer_sku_code' => $product->buyer_sku_code,
                'customer_no' => $customerNo,
                'ref_id' => $refId,
                'sign' => $signature,
            ]);

            $this->handleDigiflazzResponse($response, $transaction, $user, $finalPrice);
            
            // Reset inquiry state
            $this->inquiryData = null;
            $this->inquiryRefId = null;

            return redirect()->to('/member');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()->title('Terjadi kesalahan: ' . $e->getMessage())->danger()->send();
        }
    }

    private function handleDigiflazzResponse($response, $transaction, $user, $finalPrice)
    {
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
    }
}
