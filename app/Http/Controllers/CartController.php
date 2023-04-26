<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $validateRules = $this->createValidateRules($request, $product);

        $fields = $request->validate($validateRules);

        $this->storeProductInCart($product, $fields);

        return back();
    }

    public function storeProductInCart($product, $fields)
    {
        if ($product->type == 'pizza') {
            if (!key_exists('fillings', $fields)) {
                $fields['fillings'] = [];
            }
            if (!key_exists('sideboard', $fields)) {
                $fields['sideboard'] = 0;
            }
        }

        $cart = [];
        if (session()->has('cart')) {
            $cart = session('cart');
        }

        if (!key_exists($product->id, $cart)) {
            $fields['count'] = 1;
            $cart[$product->id][] = $fields;
        } else {
            $exists = false;
            foreach ($cart[$product->id] as &$rows) {
                $result = array_udiff_assoc($fields, $rows, function ($a, $b) {
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a > $b) ? 1 : -1;
                });
                // если пусто, то такое блюдо есть в корзине
                // просто увеличиваем count
                if (empty($result)) {
                    $rows['count']++;
                    $exists = true;
                }
            }
            // блюдо есть в корзине, но именно этого варианта параметров (моцарелла, сырный бортик и тп.) нет
            // поэтому добавляем в корзину текущие параметры
            if (!$exists) {
                $fields['count'] = 1;
                $cart[$product->id][] = $fields;
            }
        }

        session(['cart' => $cart]);
    }

    private function createValidateRules(Request $request, $product)
    {
        $validateRules = [];
        foreach ($product->fields as $field => $row) {
            switch ($product->type) {
                case 'pizza':
                    switch ($field) {
                        case 'sizes':
                            $validateRules['size'][] = 'required';
                            $validateRules['size'][] = Rule::in(array_keys($row));
                            break;
                        case 'slim_dough':
                            $validateRules['dough'][] = 'required';
                            if ($row == 0) {
                                $validateRules['dough'][] = Rule::in([1]);
                            } elseif ($request->size == 25) {
                                $validateRules['dough'][] = Rule::in([1]);
                            } else {
                                $validateRules['dough'][] = Rule::in([1, 2]);
                            }
                            break;
                        case 'sideboard':
                            if ($row == 0) {
                                $validateRules['sideboard'][] = 'exclude';
                            } else {
                                $validateRules['sideboard'][] = Rule::excludeIf(function () use ($request) {
                                    return $request->size == 25;
                                });
                                $validateRules['sideboard'][] = 'boolean';
                            }
                            break;
                        case 'fillings':
                            $validateRules['fillings'][] = 'array';
                            $validateRules['fillings.*'][] = Rule::in(array_keys($row));
                            break;
                    }
                    break;
                case 'soup':
                case 'wok':
                    $validateRules['type'][] = Rule::in(array_keys($row));
                    break;
            }
        }

        return $validateRules;
    }

    public function show()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        $cart = [];
        $products = collect();
        if (session()->has('cart')) {
            $cart = session('cart');

            $ids = array_keys($cart);
            $products = Product::whereIn('id', $ids)->get();

            foreach ($cart as $productId => &$productParams) {
                $product = $products->find($productId);
                $productFields = $product->fields;

                foreach ($productParams as &$params) {
                    $params['total_sum'] = 0;
                    switch ($product->type) {
                        case 'pizza':
                            $params['ingredients'] = 'Размер: ' . $params['size'] . ' см, ';
                            $params['ingredients'] .= ($params['dough'] == 1 ? 'традиционное' : 'тонкое') . ' тесто';
                            if ($params['sideboard']) {
                                $params['ingredients'] .= ', сырный бортик';
                            }

                            $params['total_sum'] += $productFields['sizes'][$params['size']];
                            $params['total_sum'] += $params['sideboard'] == 1 ? 900 : 0;
                            if (key_exists('fillings', $params)) {
                                foreach ($params['fillings'] as $fillingIndex) {
                                    if (key_exists($fillingIndex, $productFields['fillings'])) {
                                        $params['ingredients'] .= ', ' . $productFields['fillings'][$fillingIndex]['title'];
                                        $params['total_sum'] += $productFields['fillings'][$fillingIndex]['price'];
                                    }
                                }
                            }
                            $params['total_sum'] *= $params['count'];
                            break;
                    }
                }
            }
        }

        $breadcrumb = [
            [
                'url' => route('home'),
                'title' => 'Главная'
            ],
            [
                'url' => false,
                'title' => 'Корзина'
            ]
        ];

        return view('cart', compact('cart', 'categories', 'breadcrumb', 'products'));
    }
}
