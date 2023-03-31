<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->unique()->sentence(3),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'image' => fake()->imageUrl(200, 150, null, true, null, false, 'png'),
            'ingredients' => fake()->sentence(6),
        ];
    }
}
