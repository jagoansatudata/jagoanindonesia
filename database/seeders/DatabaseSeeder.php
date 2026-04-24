<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'demo@jagoanindonesia.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('demo123'),
                'is_admin' => false,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@jagoanindonesia.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        $this->call([
            ActivitySeeder::class,
            ClientSeeder::class,
            TeamMemberSeeder::class,
            ClientReviewSeeder::class,
            CareerStatsSeeder::class,
            HeroSectionSeeder::class,
        ]);
    }
}
