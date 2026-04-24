<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Semarak Muda Semarang (SMS) 2025',
                'category' => 'Inkubasi Bisnis',
                'image_path' => null,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'Jagoan Banyuwangi 2025',
                'category' => 'Strategist Event',
                'image_path' => null,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'title' => 'Art Coffee and Festival (Artcofest) 2026',
                'category' => 'Workshop',
                'image_path' => null,
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'title' => 'Artificial Intelligence for ASN (AiSN) Banyuwangi 2026',
                'category' => 'Workshop',
                'image_path' => null,
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($items as $item) {
            Activity::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'category' => $item['category'],
                    'image_path' => $item['image_path'],
                    'is_published' => $item['is_published'],
                    'sort_order' => $item['sort_order'],
                ]
            );
        }
    }
}
