<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->count(3)
            ->create();

        $categories = Category::factory()->count(3)->create();

        $users->map(function ($user) use ($categories) {
            $categories->map(function ($category) use ($user) {
                Post::factory()->create([
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                ]);
            });
        });


    }
}
