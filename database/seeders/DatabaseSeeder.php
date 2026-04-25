<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            ActivitySeeder::class,
            ClientSeeder::class,
            TeamMemberSeeder::class,
            ClientReviewSeeder::class,
            CareerStatsSeeder::class,
            HeroSectionSeeder::class,
        ]);
    }
}
