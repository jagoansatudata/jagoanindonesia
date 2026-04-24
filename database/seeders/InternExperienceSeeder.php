<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\InternExperience::create([
            'intern_name' => 'Ahmad Rizki',
            'intern_role' => 'Frontend Developer',
            'experience_content' => 'Magang di Jagoan Indonesia memberikan pengalaman berharga dalam pengembangan web modern. Saya belajar banyak tentang React, Laravel, dan best practices dalam industri teknologi.',
            'rating' => 5,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        \App\Models\InternExperience::create([
            'intern_name' => 'Siti Nurhaliza',
            'intern_role' => 'UI/UX Designer',
            'experience_content' => 'Program internship yang sangat terstruktur dan mendukung pengembangan karir. Saya terlibat dalam proyek nyata dan mendapat mentorship dari tim senior.',
            'rating' => 5,
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}
