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
    protected static ?string $navigationLabel = 'Transaksi Produk';
    
    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        $filter = request()->query('filter');
        if ($filter) {
            return 'Transaksi ' . ucwords(strtolower($filter));
        }
        return 'Pembelian Produk';
    }
    
    // Hide from sidebar to force users to use Dashboard icons
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.member.pages.purchase-product';

    public ?array $data = [];
    public ?string $type = 'prepaid';
    public ?string $filter = 'Pulsa';
    
    public ?array $inquiryData = null;
    public ?string $inquiryRefId = null;
    public ?string $errorMessage = null;
    public ?string $errorTitle = null;

    public function mount(): void
    {
        $this->type = request()->query('type', 'prepaid');
        $this->filter = request()->query('filter', 'Pulsa');
        $this->form->fill();
    }

    public function isPostpaid(): bool
    {
        return $this->type === 'postpaid';
    }

    public function cancelInquiry(): void
    {
        $this->inquiryData = null;
        $this->inquiryRefId = null;
        $this->errorMessage = null;
        $this->errorTitle = null;
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
        
        if ($this->isPostpaid()) {
            $query->where('category', 'Pascabayar')->where('brand', $this->filter);
        } else {
            $query->where('category', $this->filter);
        }
                        
        if ($brand && in_array(strtolower($this->filter), ['pulsa', 'data'])) {
            $query->where('brand', $brand);
        }
        
        return $query->get();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        $customerNoLabel = 'Nomor Tujuan';
        $customerNoPlaceholder = 'Masukkan nomor';
        
        $filterLower = strtolower($this->filter);

        if ($this->isPostpaid()) {
            $customerNoLabel = 'ID Pelanggan';
            $customerNoPlaceholder = 'Masukkan ID Pelanggan';
            if (str_contains($filterLower, 'pln')) {
                $customerNoLabel = 'No. Meter / ID Pelanggan';
                $customerNoPlaceholder = '123456789012';
            }
        } else {
            if (str_contains($filterLower, 'pulsa') || str_contains($filterLower, 'data') || str_contains($filterLower, 'e-money') || str_contains($filterLower, 'ewallet')) {
                $customerNoLabel = 'Nomor HP / Akun';
                $customerNoPlaceholder = '081234567890';
            } elseif (str_contains($filterLower, 'pln')) {
                $customerNoLabel = 'No. Meter / ID Pelanggan';
                $customerNoPlaceholder = '123456789012';
            } elseif (str_contains($filterLower, 'game')) {
                $customerNoLabel = 'User ID';
                $customerNoPlaceholder = '12345678';
            }
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
                    ->hidden(fn () => !str_contains(strtolower($this->filter), 'game')),
                    
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
        $this->errorMessage = null;
        $this->errorTitle = null;
        
        $data = $this->form->getState();
        $user = auth()->user();
        $markup = $user->markup ?? 500;
        
        $customerNo = $data['customer_no'];
        if (str_contains(strtolower($this->filter), 'game') && !empty($data['zone_id'])) {
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

            $response = Http::timeout(60)->post('https://api.digiflazz.com/v1/transaction', [
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
            $response = Http::timeout(60)->post('https://api.digiflazz.com/v1/transaction', [
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
                    $this->errorTitle = 'Gagal Cek Tagihan';
                    $this->errorMessage = $result['data']['message'] ?? 'Tagihan tidak ditemukan atau sudah dibayar.';
                    Notification::make()->title('Gagal Cek Tagihan')->body($this->errorMessage)->danger()->send();
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

            // Save transaction using the SAME ref_id as the inquiry
            $refId = $this->inquiryRefId;

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

            $response = Http::timeout(60)->post('https://api.digiflazz.com/v1/transaction', [
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
            
            try {
                $notifMsg = "<b>🛒 Transaksi PPOB Baru!</b>\n\n"
                     . "<b>Member:</b> {$user->name}\n"
                     . "<b>Produk:</b> {$transaction->buyer_sku_code}\n"
                     . "<b>Tujuan:</b> {$transaction->customer_no}\n"
                     . "<b>Harga:</b> Rp " . number_format($finalPrice, 0, ',', '.') . "\n"
                     . "<b>Status:</b> " . strtoupper($status) . "\n"
                     . "<b>SN/Pesan:</b> " . ($result['data']['sn'] ?? $message);
                \App\Services\TelegramService::sendToGroup($notifMsg);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal kirim notif telegram trx: ' . $e->getMessage());
            }

            if ($status === 'Gagal') {
                // Refund
                $user->saldo += $finalPrice;
                $user->save();
                Notification::make()->title('Transaksi Gagal: ' . $message)->warning()->send();
            } else {
                Notification::make()->title('Transaksi Berhasil Dibuat')->success()->send();
            }
        } else {
            // Error without 'data' wrapper
            $message = $result['message'] ?? 'Respon tidak valid dari server pusat.';
            $transaction->update([
                'status' => 'Gagal',
                'message' => $message,
            ]);
            
            // Refund
            $user->saldo += $finalPrice;
            $user->save();
            Notification::make()->title('Transaksi Gagal: ' . $message)->danger()->send();
        }
    }
}
