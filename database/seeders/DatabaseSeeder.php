<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed if database is empty (prevents duplicate seed on redeploys)
        if (User::count() === 0) {
            $this->call([
                AdminUserSeeder::class,
                CategorySeeder::class,
                ProductSeeder::class,
            ]);
        }
    }
}