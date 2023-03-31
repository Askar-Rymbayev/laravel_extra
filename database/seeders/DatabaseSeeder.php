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

        $categoryTypes = [
            'Пицца' => 'pizza',
            'Роллы' => 'rolls',
            'Суши' => 'sushi',
            'Супы' => 'soup',
            'Wok' => 'wok',
            'Дополнительно' => 'additional'];
        $categories = [];
        foreach ($categoryTypes as $categoryType => $value) {
            $categories[] = Category::factory()->create([
                'title' => $categoryType
            ]);
        }
        $categories = collect($categories);

        $categories->map(function ($category) use ($categoryTypes) {
            $subCategories = Category::factory()->count(4)->create([
                'parent_id' => $category->id
            ]);

            $productType = $category->title;

            $subCategories->map(function ($subCategory) use ($productType, $categoryTypes) {
                $customField = null;
                $pizza = ['small', 'medium', 'big'];
                $rolls = [8, 10];
                $meat = ['chicken', 'beef', 'turkey'];
                switch ($productType)
                {
                    case 'Пицца':
                        $customField = $pizza[rand(0, 2)];
                        break;
                    case 'Роллы':
                        $customField = $rolls[rand(0, 1)];
                        break;
                    case 'Супы':
                    case 'Wok':
                        $customField = $meat[rand(0, 2)];
                        break;
                }

                Product::factory()->count(4)->create([
                    'category_id' => $subCategory->id,
                    'type' => $categoryTypes[$productType],
                    'custom_field' => $customField,
                ]);
            });
        });
    }
}
