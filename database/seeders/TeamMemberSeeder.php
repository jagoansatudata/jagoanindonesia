<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Dias Satria',
                'position' => 'Founder',
                'photo' => 'dias-satria.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Puspita Wikanandha',
                'position' => 'Chief Executive Officer',
                'photo' => 'puspita.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Sukma Maharani',
                'position' => 'Chief Financial Officer',
                'photo' => 'rani.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Rizki',
                'position' => 'Chief Technology Officer',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Putri',
                'position' => 'Chief Marketing Officer',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'position' => 'Chief Operating Officer',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
