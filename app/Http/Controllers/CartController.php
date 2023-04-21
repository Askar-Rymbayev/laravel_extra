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
                $result = array_udiff_assoc($fields, $rows, function ($a, $b) {
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a > $b) ? 1 : -1;
                });
                if (!empty($result)) {
                }
            }
        }

        // что здесь в логике есть проблема
        // в след уроке объясню в чём проблема

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
}
