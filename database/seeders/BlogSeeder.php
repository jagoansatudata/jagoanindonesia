<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory()->count(15)->create();
        
        // Create some specific blog posts for better demo content
        Blog::create([
            'title' => 'The Future of Web Development: Trends to Watch in 2024',
            'slug' => 'future-web-development-trends-2024',
            'excerpt' => 'Explore the latest trends shaping the web development landscape, from AI-powered tools to advanced frameworks.',
            'content' => 'The web development industry is constantly evolving. In this comprehensive guide, we explore the cutting-edge technologies and methodologies that are defining the future of web development. From the rise of AI-assisted coding to the growing importance of performance optimization, developers need to stay ahead of the curve to remain competitive in this fast-paced field.',
            'image' => 'images/blog/web-dev-trends.jpg',
            'author' => 'John Developer',
            'category' => 'Technology',
            'status' => 'published',
            'featured' => true,
            'published_at' => now()->subDays(5),
        ]);

        Blog::create([
            'title' => 'Building Scalable Business Applications with Modern Architecture',
            'slug' => 'scalable-business-applications-modern-architecture',
            'excerpt' => 'Learn how to design and implement business applications that can grow with your organization.',
            'content' => 'Modern business applications require careful planning and architecture to ensure they can scale effectively. This article covers best practices for designing systems that can handle growth, from microservices to database optimization strategies.',
            'image' => 'images/blog/scalable-apps.jpg',
            'author' => 'Sarah Architect',
            'category' => 'Business',
            'status' => 'published',
            'featured' => true,
            'published_at' => now()->subDays(12),
        ]);

        Blog::create([
            'title' => 'UX Design Principles for Modern Web Interfaces',
            'slug' => 'ux-design-principles-modern-web-interfaces',
            'excerpt' => 'Essential UX design principles that every web designer should know for creating user-friendly interfaces.',
            'content' => 'User experience design is at the heart of successful web applications. This comprehensive guide covers the fundamental principles of UX design, from user research to interface design, helping you create interfaces that users love.',
            'image' => 'images/blog/ux-design.jpg',
            'author' => 'Emily Designer',
            'category' => 'Design',
            'status' => 'published',
            'featured' => false,
            'published_at' => now()->subDays(20),
        ]);
    }
}
