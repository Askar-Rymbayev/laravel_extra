<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $validateRules = $this->createValidateRules($request, $product);

        dd($request->all());

        $fields = $request->validate($validateRules);

        $this->storeProductInCart($request, $product, $fields);

        return back();
    }

    public function storeProductInCart(Request $request, $product, $fields)
    {
        $cart = [];
        if (session()->has('cart')) {
            $cart = session('cart');
        }

        if (!key_exists($product->id, $cart)) {
            $fields['count'] = 1;
            $cart[$product->id][] = $fields;
        } else {
            foreach ($cart[$product->id] as $rows) {
                foreach ($rows as $row) {
                    foreach ($fields as $field) {

                    }
                }
            }
        }

        dd($cart);

        /*
          "size" => "30"
          "fillings" => "0"
          "dough" => "2"
        */

        $cart = [
            1 => [
                [
                    'size' => 25,
                    'dough' => 1,
                    'fillings' => [
                        0, 1
                    ],
                    'count' => 3,
                ],
                [
                    'size' => 30,
                    'dough' => 1,
                    'sideboard' => 1,
                    'fillings' => [
                        1
                    ],
                    'count' => 2,
                ],
                [
                    'size' => 30,
                    'sideboard' => 1,
                    'dough' => 2,
                    'fillings' => [
                        0
                    ],
                    'count' => 1,
                ],
            ],
            2 => [

            ]
        ];

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
                            $validateRules['fillings'][] = Rule::in(array_keys($row));
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
}
