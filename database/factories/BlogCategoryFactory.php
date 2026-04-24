<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Technology', 'color' => '#3B82F6', 'sort_order' => 1],
            ['name' => 'Business', 'color' => '#10B981', 'sort_order' => 2],
            ['name' => 'Design', 'color' => '#F59E0B', 'sort_order' => 3],
            ['name' => 'Marketing', 'color' => '#EF4444', 'sort_order' => 4],
            ['name' => 'Development', 'color' => '#8B5CF6', 'sort_order' => 5],
            ['name' => 'Innovation', 'color' => '#EC4899', 'sort_order' => 6],
        ];
        
        $category = $this->faker->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'slug' => \Illuminate\Support\Str::slug($category['name']),
            'description' => $this->faker->sentence(10),
            'color' => $category['color'],
            'is_active' => true,
            'sort_order' => $category['sort_order'],
        ];
    }
}
