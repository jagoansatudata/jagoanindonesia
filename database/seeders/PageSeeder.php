<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'description' => 'Main dashboard page with overview statistics',
                'route_name' => 'admin.dashboard',
                'is_active' => true,
            ],
            [
                'name' => 'User Management',
                'slug' => 'user-management',
                'description' => 'Manage application users and permissions',
                'route_name' => 'admin.users.index',
                'is_active' => true,
            ],
            [
                'name' => 'Page Access Control',
                'slug' => 'page-access-control',
                'description' => 'Control user access to specific pages',
                'route_name' => 'admin.pages.index',
                'is_active' => true,
            ],
            [
                'name' => 'Activities Management',
                'slug' => 'activities-management',
                'description' => 'Manage activities for the home page',
                'route_name' => 'admin.activities.index',
                'is_active' => true,
            ],
            [
                'name' => 'Blog Management',
                'slug' => 'blog-management',
                'description' => 'Manage blog posts and categories',
                'route_name' => 'admin.blogs.index',
                'is_active' => true,
            ],
            [
                'name' => 'Client Reviews',
                'slug' => 'client-reviews',
                'description' => 'Manage client testimonials and reviews',
                'route_name' => 'client-reviews.index',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
