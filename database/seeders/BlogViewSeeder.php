<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogView;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some sample blogs
        $blogs = Blog::take(5)->get();
        
        if ($blogs->isEmpty()) {
            $this->command->info('No blogs found to create views for.');
            return;
        }

        // Create sample view data for the last 30 days
        foreach ($blogs as $blog) {
            // Generate random number of views (between 10 and 100)
            $viewCount = rand(10, 100);
            
            for ($i = 0; $i < $viewCount; $i++) {
                BlogView::create([
                    'blog_id' => $blog->id,
                    'ip_address' => $this->generateRandomIp(),
                    'user_agent' => $this->generateRandomUserAgent(),
                    'referer' => $this->generateRandomReferer(),
                    'viewed_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                ]);
            }
        }

        $this->command->info('Sample blog view data created successfully.');
    }

    /**
     * Generate a random IP address.
     */
    private function generateRandomIp(): string
    {
        return sprintf(
            '%d.%d.%d.%d',
            rand(1, 255),
            rand(1, 255),
            rand(1, 255),
            rand(1, 255)
        );
    }

    /**
     * Generate a random user agent string.
     */
    private function generateRandomUserAgent(): string
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:89.0) Gecko/20100101 Firefox/89.0',
        ];

        return $userAgents[array_rand($userAgents)];
    }

    /**
     * Generate a random referer URL.
     */
    private function generateRandomReferer(): ?string
    {
        $referers = [
            'https://www.google.com/',
            'https://www.facebook.com/',
            'https://twitter.com/',
            'https://www.linkedin.com/',
            'https://www.instagram.com/',
            null, // Direct traffic
        ];

        return $referers[array_rand($referers)];
    }
}
