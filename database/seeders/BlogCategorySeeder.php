<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest trends and innovations in technology, software development, and digital transformation.',
                'color' => '#3B82F6',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business strategies, entrepreneurship, market insights, and corporate growth.',
                'color' => '#10B981',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'UI/UX design, visual arts, creative processes, and design thinking.',
                'color' => '#F59E0B',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Digital marketing, branding, content strategies, and customer engagement.',
                'color' => '#EF4444',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Development',
                'slug' => 'development',
                'description' => 'Web development, mobile apps, software engineering, and coding best practices.',
                'color' => '#8B5CF6',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Innovation',
                'slug' => 'innovation',
                'description' => 'Cutting-edge innovations, research breakthroughs, and future technologies.',
                'color' => '#EC4899',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
