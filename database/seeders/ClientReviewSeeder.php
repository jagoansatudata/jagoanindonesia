<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientReview;

class ClientReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'reviewer_name' => 'Matt Stoney',
                'reviewer_title' => 'Jr. Manager',
                'review_content' => 'Working with this team has been an incredible experience. Their professionalism and attention to detail exceeded our expectations. The project was delivered on time and the quality was outstanding.',
                'rating' => 5,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'reviewer_name' => 'Sara Johnson',
                'reviewer_title' => 'Marketing Director',
                'review_content' => 'Exceptional service and remarkable results! They understood our needs perfectly and delivered solutions that transformed our business. Highly recommend their expertise and dedication.',
                'rating' => 5,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'reviewer_name' => 'David Chen',
                'reviewer_title' => 'CEO',
                'review_content' => 'A truly professional team that delivers on promises. Their innovative approach and technical skills helped us achieve our goals faster than we anticipated.',
                'rating' => 4,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'reviewer_name' => 'Emily Rodriguez',
                'reviewer_title' => 'Product Manager',
                'review_content' => 'Great collaboration and outstanding communication throughout the project. The team went above and beyond to ensure our success. Will definitely work with them again.',
                'rating' => 5,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'reviewer_name' => 'Michael Park',
                'reviewer_title' => 'CTO',
                'review_content' => 'Technical excellence combined with business understanding. They provided solutions that were not only technically sound but also aligned perfectly with our business objectives.',
                'rating' => 4,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($reviews as $review) {
            ClientReview::create($review);
        }
    }
}
