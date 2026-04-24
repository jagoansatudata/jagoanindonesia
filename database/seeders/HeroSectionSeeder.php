<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSection;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'title' => 'Strategi Terarah<br>Dampak <span class="hero-title-accent">Nyata</span>',
            'subtitle' => 'Solusi strategis untuk bisnis dan instansi yang ingin tumbuh secara terarah dan berkelanjutan.',
            'button_text' => 'Mulai Sekarang',
            'button_url' => '#contact',
            'background_image' => null,
            'is_active' => true,
        ]);
    }
}
