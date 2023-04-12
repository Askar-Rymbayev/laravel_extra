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
                for ($i=1; $i <= 4; $i++) {
                    $customField = null;
                    switch ($productType) {
                        case 'Пицца':
                            $sizes = [
                                25 => rand(2000, 3000),
                                30 => rand(2500, 3500),
                                35 => rand(3000, 4000),
                                40 => rand(3500, 4500),
                            ];
                            $slim_dough = rand(0, 1);
                            $sideboard = rand(0, 1);
                            $fillings = [
                                [
                                    'title' => 'Моцарелла',
                                    'exists' => rand(0, 1),
                                    'price' => 350,
                                ],
                                [
                                    'title' => 'Острый халапенью',
                                    'exists' => rand(0, 1),
                                    'price' => 250,
                                ],
                                [
                                    'title' => 'Цыплёнок',
                                    'exists' => rand(0, 1),
                                    'price' => 250,
                                ],
                            ];

                            $customField = [
                                'sizes' => $sizes,
                                'slim_dough' => $slim_dough,
                                'sideboard' => $sideboard,
                                'fillings' => [],
                            ];

                            foreach ($fillings as $item) {
                                if ($item['exists']) {
                                    $customField['fillings'][] = $item;
                                }
                            }
                            break;
                        case 'Роллы':
                            $types = [
                                'запеченые',
                                'теплые',
                                'холодные',
                                'мини',
                            ];
                            $customField = [
                                'count' => [8, 10][rand(0, 1)],
                                'type' => $types[rand(0, 3)]
                            ];
                            break;
                        case 'Супы':
                            $types = [
                                [
                                    'title' => 'с говядиной',
                                    'exists' => rand(0, 1),
                                    'price' => 300,
                                ],
                                [
                                    'title' => 'с курицей',
                                    'exists' => rand(0, 1),
                                    'price' => 250,
                                ],
                                [
                                    'title' => 'с моцареллой',
                                    'exists' => rand(0, 1),
                                    'price' => 350,
                                ],
                                [
                                    'title' => 'классический',
                                    'exists' => rand(0, 1),
                                    'price' => 200,
                                ],
                                [
                                    'title' => 'с лососем',
                                    'exists' => rand(0, 1),
                                    'price' => 500,
                                ],
                                [
                                    'title' => 'с креветками',
                                    'exists' => rand(0, 1),
                                    'price' => 500,
                                ],
                            ];

                            $customField = [
                                'type' => null
                            ];
                            foreach ($types as $item) {
                                if ($item['exists']) {
                                    $customField['type'][] = $item;
                                }
                            }
                            break;
                        case 'Wok':
                            $types = [
                                [
                                    'title' => 'с говядиной',
                                    'exists' => rand(0, 1),
                                    'price' => 300,
                                ],
                                [
                                    'title' => 'с курицей',
                                    'exists' => rand(0, 1),
                                    'price' => 250,
                                ],
                                [
                                    'title' => 'с уткой',
                                    'exists' => rand(0, 1),
                                    'price' => 350,
                                ],
                                [
                                    'title' => 'с креветками',
                                    'exists' => rand(0, 1),
                                    'price' => 500,
                                ],
                            ];
                            $customField = [
                                'type' => null
                            ];
                            foreach ($types as $item) {
                                if ($item['exists']) {
                                    $customField['type'][] = $item;
                                }
                            }
                            break;
                    }

                    Product::factory()->create([
                        'category_id' => $subCategory->id,
                        'type' => $categoryTypes[$productType],
                        'fields' => $customField,
                    ]);
                }
            });
        });
    }
}
