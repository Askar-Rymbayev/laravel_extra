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
                if (empty($result)) {
                    $rows['count']++;
                    $exists = true;
                }
            }
            if (!$exists) {
                $fields['count'] = 1;
                $cart[$product->id][] = $fields;
            }
        }

        session(['cart' => $cart]);
    }

    private function udiffAssoc($fields, $rows)
    {
        $keys = array_merge(array_keys($fields), array_keys($rows));
        dd($keys);
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
        //подсчёт стоимости каждой пиццы
        //вытащить все данные из json блюда
        $cart = session('cart');

        foreach ($cart as $productId => $productParams) {
            $product = Product::find($productId);
            foreach ($productParams as $productParam) {

            }
        }

        return view('cart');
    }
}
