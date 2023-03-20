<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
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
        User::factory()
            ->count(3)
            ->create();

        $categoryTypes = ['pizza', 'rolls', 'sushi', 'soup', 'wok', 'additional'];
        $categories = [];
        foreach ($categoryTypes as $categoryType) {
            $categories[] = Category::factory()->create([
                'title' => $categoryType
            ]);
        }
        $categories = collect($categories);

        $categories->map(function ($category) {
            $subCategories = Category::factory()->count(4)->create([
                'parent_id' => $category->id
            ]);

            $productType = $category->title;

            $subCategories->map(function ($subCategory) use ($productType) {
                $customField = null;
                $pizza = ['small', 'medium', 'big'];
                $rolls = [8, 10];
                $meat = ['chicken', 'beaf', 'turkey'];
                switch ($productType)
                {
                    case 'pizza':
                        $customField = $pizza[rand(0, 2)];
                        break;
                    case 'rolls':
                        $customField = $rolls[rand(0, 1)];
                        break;
                    case 'soup':
                    case 'wok':
                        $customField = $meat[rand(0, 2)];
                        break;
                }

                Product::factory()->count(4)->create([
                    'category_id' => $subCategory->id,
                    'type' => $productType,
                    'custom_field' => $customField,
                ]);
            });
        });
    }
}
