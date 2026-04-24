<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'title' => 'Digital Transformation Strategies for Modern Businesses in 2024',
            'slug' => 'digital-transformation-strategies-2024',
            'excerpt' => 'Learn about the latest digital transformation strategies that can help your business thrive in 2024.',
            'content' => 'Full content about digital transformation strategies...',
            'author' => 'Alex Johnson',
            'type' => 'blog',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Blog::create([
            'title' => 'The Future of Remote Work: Trends and Best Practices',
            'slug' => 'future-remote-work-trends-2024',
            'excerpt' => 'Discover the latest trends and best practices for remote work in the modern workplace.',
            'content' => 'Full content about remote work trends...',
            'author' => 'Emma Wilson',
            'type' => 'blog',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        Blog::create([
            'title' => 'Sustainable Business Practices: How Companies Are Going Green',
            'slug' => 'sustainable-business-practices-2024',
            'excerpt' => 'Explore how companies are implementing sustainable practices to reduce their environmental impact.',
            'content' => 'Full content about sustainable business practices...',
            'author' => 'Michael Brown',
            'type' => 'blog',
            'status' => 'published',
            'published_at' => now()->subDays(3),
        ]);
    }
}
