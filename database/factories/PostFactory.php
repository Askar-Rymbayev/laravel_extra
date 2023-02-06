<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => fake()->unique()->lexify('my-???????-post'),
            'title' => fake()->unique()->sentence(3),
            'descr' => fake()->paragraph(4),
            'body' => fake()->text(400)
        ];
    }
}
