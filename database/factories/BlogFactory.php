<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6, 10);
        $categories = ['Technology', 'Business', 'Design'];
        
        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'images/blog/blog-' . $this->faker->numberBetween(1, 10) . '.jpg',
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement($categories),
            'status' => 'published',
            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
