<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@jagoanindonesia.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('demo123'),
                'role' => UserRole::USER,
                'is_admin' => false,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@jagoanindonesia.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => UserRole::ADMIN,
                'is_admin' => true,
            ]
        );
    }
}
