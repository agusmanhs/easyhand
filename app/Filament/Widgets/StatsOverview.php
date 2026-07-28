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
        
        $totalUsers = User::count();
        $totalTransactions = \App\Models\Transaction::count();
        $totalDeposits = \App\Models\Deposit::where('status', 'approved')->sum('amount');
        $pendingDeposits = \App\Models\Deposit::where('status', 'pending')->count();
        
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
            Stat::make('TOTAL USERS', number_format($totalUsers, 0, ',', '.'))
                ->description('Total member terdaftar')
                ->color('primary')
                ->icon('heroicon-o-users'),
            Stat::make('TRANSACTIONS', number_format($totalTransactions, 0, ',', '.'))
                ->description('Total transaksi yang diproses')
                ->color('primary')
                ->icon('heroicon-o-document-text'),
            Stat::make('TOTAL DEPOSIT', 'Rp ' . number_format($totalDeposits, 0, ',', '.'))
                ->description('Total deposit berhasil')
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('PENDING DEPOSIT', number_format($pendingDeposits, 0, ',', '.'))
                ->description('Menunggu persetujuan')
                ->color($pendingDeposits > 0 ? 'warning' : 'primary')
                ->icon('heroicon-o-clock'),
        ];
    }
}
