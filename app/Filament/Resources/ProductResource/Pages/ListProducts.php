<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use App\Models\Setting;
use App\Models\Product;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Produk'),
            'prabayar' => Tab::make('Prabayar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('product_type', 'prabayar')),
            'pascabayar' => Tab::make('Pascabayar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('product_type', 'pascabayar')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync')
                ->label('Sync Digiflazz')
                ->color('success')
                ->icon('heroicon-o-arrow-path')
                ->action(function () {
                    $this->syncDigiflazz();
                }),
            Actions\CreateAction::make(),
        ];
    }

    protected function syncDigiflazz()
    {
        $usernameSetting = Setting::where('key', 'digiflazz_username')->first();
        $keySetting = Setting::where('key', 'digiflazz_production_key')->first();

        if (!$usernameSetting || !$keySetting) {
            Notification::make()->title('Gagal')->body('Kredensial Digiflazz belum diatur')->danger()->send();
            return;
        }

        $user = $usernameSetting->value;
        $key = $keySetting->value;
        $sign = md5($user . $key . 'pricelist');
        
        $totalSynced = 0;

        // Sync Prepaid
        $payloadPrepaid = json_encode(['cmd' => 'prepaid', 'username' => $user, 'sign' => $sign]);
        $ch = curl_init('https://api.digiflazz.com/v1/price-list');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadPrepaid);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $resPrepaid = curl_exec($ch);
        curl_close($ch);

        $responsePrepaid = json_decode($resPrepaid);
        if (isset($responsePrepaid->data) && is_array($responsePrepaid->data)) {
            foreach ($responsePrepaid->data as $item) {
                Product::updateOrCreate(
                    ['buyer_sku_code' => $item->buyer_sku_code],
                    [
                        'product_type' => 'prabayar',
                        'product_name' => $item->product_name,
                        'category' => $item->category,
                        'brand' => $item->brand,
                        'type' => $item->type ?? 'Umum',
                        'seller_name' => $item->seller_name,
                        'price' => $item->price,
                        'buyer_product_status' => $item->buyer_product_status,
                        'seller_product_status' => $item->seller_product_status,
                        'unlimited_stock' => $item->unlimited_stock,
                        'stock' => $item->stock,
                        'multi' => $item->multi,
                        'start_cut_off' => $item->start_cut_off,
                        'end_cut_off' => $item->end_cut_off,
                        'desc' => $item->desc,
                    ]
                );
                $totalSynced++;
            }
        }

        // Sync Postpaid
        $payloadPasca = json_encode(['cmd' => 'pasca', 'username' => $user, 'sign' => $sign]);
        $ch = curl_init('https://api.digiflazz.com/v1/price-list');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadPasca);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $resPasca = curl_exec($ch);
        curl_close($ch);

        $responsePasca = json_decode($resPasca);
        if (isset($responsePasca->data) && is_array($responsePasca->data)) {
            foreach ($responsePasca->data as $item) {
                Product::updateOrCreate(
                    ['buyer_sku_code' => $item->buyer_sku_code],
                    [
                        'product_type' => 'pascabayar',
                        'product_name' => $item->product_name,
                        'category' => $item->category,
                        'brand' => $item->brand,
                        'type' => 'Pascabayar',
                        'seller_name' => $item->seller_name,
                        'price' => 0, // As requested by user
                        'buyer_product_status' => $item->buyer_product_status,
                        'seller_product_status' => $item->seller_product_status,
                        'unlimited_stock' => $item->unlimited_stock ?? false,
                        'stock' => $item->stock ?? 0,
                        'multi' => $item->multi ?? false,
                        'start_cut_off' => $item->start_cut_off ?? null,
                        'end_cut_off' => $item->end_cut_off ?? null,
                        'desc' => $item->desc,
                    ]
                );
                $totalSynced++;
            }
        }
        
        if ($totalSynced > 0) {
            Notification::make()->title('Sinkronisasi Selesai')->body("Berhasil sync {$totalSynced} produk.")->success()->send();
        } else {
            Notification::make()->title('Sinkronisasi Gagal')->body('Tidak ada produk yang berhasil disinkronisasi. Cek kredensial Digiflazz Anda.')->danger()->send();
        }
    }
}
