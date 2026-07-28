<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Setting;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected function getStats(): array
    {
        // Get Total Member Balance
        $totalMemberBalance = User::sum('saldo');
        
        // Get Digiflazz Balance
        $saldoDigiflazz = 0;
        $digiflazzStatus = 'Gagal mengecek saldo';
        $digiflazzColor = 'danger';
        
        $usernameSetting = Setting::where('key', 'digiflazz_username')->first();
        $keySetting = Setting::where('key', 'digiflazz_production_key')->first();
        
        if ($usernameSetting && $keySetting) {
            $user = $usernameSetting->value;
            $key = $keySetting->value;
            $sign = md5($user . $key . 'depo');
            
            $payload = json_encode(['cmd' => 'deposit', 'username' => $user, 'sign' => $sign]);
            
            $ch = curl_init('https://api.digiflazz.com/v1/cek-saldo');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            
            $res = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($res);
            if (isset($response->data->deposit)) {
                $saldoDigiflazz = $response->data->deposit;
                $digiflazzStatus = 'Berhasil tersinkronisasi';
                $digiflazzColor = 'success';
            } else {
                $digiflazzStatus = $response->data->message ?? 'Signature salah atau masalah API';
            }
        } else {
            $digiflazzStatus = 'Kredensial belum diatur';
        }
        
        return [
            Stat::make('SALDO MEMBER', 'Rp ' . number_format($totalMemberBalance, 0, ',', '.'))
                ->description('Total saldo gabungan')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->icon('heroicon-o-wallet'),
            Stat::make('SALDO PROVIDER', 'Rp ' . number_format($saldoDigiflazz, 0, ',', '.'))
                ->description($digiflazzStatus)
                ->descriptionIcon($digiflazzColor === 'success' ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->color($digiflazzColor)
                ->icon('heroicon-o-building-storefront'),
            Stat::make('TOTAL USERS', '14,285')
                ->description('+12%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->icon('heroicon-o-users'),
            Stat::make('TRANSACTIONS', '48,902')
                ->description('+8.4%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([3, 12, 4, 10, 2, 15, 17])
                ->icon('heroicon-o-document-text'),
            Stat::make('TOTAL REVENUE', 'Rp 1.24M')
                ->description('-2.1%')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('ORDERS', '1,894')
                ->description('+24%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->icon('heroicon-o-shopping-cart'),
        ];
    }
}
