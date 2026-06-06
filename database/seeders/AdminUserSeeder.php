<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Zaker Admin',
            'email' => 'admin@tajer.af',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Demo Customer',
            'email' => 'demo@tajer.af',
            'password' => Hash::make('demo123'),
            'is_admin' => false,
        ]);
    }
}