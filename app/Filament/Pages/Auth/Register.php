<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration($data);
        
        // Pastikan role member ada, dan berikan ke user baru
        $role = Role::firstOrCreate(['name' => 'member']);
        $user->assignRole($role);
        
        // Saldo default 0 saat register
        $user->saldo = 0;
        $user->save();
        
        return $user;
    }
}
