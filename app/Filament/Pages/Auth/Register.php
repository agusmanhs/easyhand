<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Register extends BaseRegister
{
    protected static string $view = 'filament.pages.auth.register';
    protected static string $layout = 'filament-panels::components.layout.base';

    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration($data);
        
        // Pastikan role member ada, dan berikan ke user baru
        $role = Role::firstOrCreate(['name' => 'member']);
        $user->assignRole($role);
        
        // Saldo default 0 saat register
        $user->saldo = 0;
        $user->save();
        
        try {
            $msg = "<b>🎉 Pengguna Baru Terdaftar!</b>\n\n"
                 . "<b>Nama:</b> {$user->name}\n"
                 . "<b>Email:</b> {$user->email}\n"
                 . "<b>Waktu:</b> " . now()->format('d M Y H:i:s');
            \App\Services\TelegramService::sendToGroup($msg);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal kirim notif telegram: ' . $e->getMessage());
        }
        
        return $user;
    }
}
