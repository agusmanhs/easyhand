<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role admin sudah ada (menggunakan Spatie Permission)
        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);

        // Buat user admin (atau perbarui jika sudah ada)
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@easyhand.my.id'],
            [
                'name' => 'Admin EasyHand',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'saldo' => 0,
            ]
        );

        // Assign role admin ke user
        $admin->assignRole($role);

        $this->command->info('Admin user created/updated successfully! Email: admin@easyhand.my.id | Password: password');
    }
}
