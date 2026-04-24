<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Universitas Indonesia',
                'logo_path' => null,
                'website_url' => 'https://www.ui.ac.id',
                'description' => 'Universitas terkemuka di Indonesia dengan berbagai program studi unggulan',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'logo_path' => null,
                'website_url' => 'https://www.itb.ac.id',
                'description' => 'Institusi pendidikan teknik dan sains terkemuka di Indonesia',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'logo_path' => null,
                'website_url' => 'https://www.ugm.ac.id',
                'description' => 'Universitas negeri tertua dan terbesar di Indonesia',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Universitas Airlangga',
                'logo_path' => null,
                'website_url' => 'https://www.unair.ac.id',
                'description' => 'Universitas terkemuka di Surabaya dengan fokus pada kesehatan dan sains',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($universities as $university) {
            University::create($university);
        }
    }
}
