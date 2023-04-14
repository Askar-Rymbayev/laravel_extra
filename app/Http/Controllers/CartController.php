<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        dd($request->all());

        $product = Product::findOrFail($request->id);

        $validateRules = $this->createValidateRules($product);

        $validated = $request->validate($validateRules);

        $customField = $request->get('custom_field');

        $this->storeProductInCart($product, $customField);

        return back();
    }

    public function storeProductInCart($product, $customField)
    {
        $cart = session('cart');
        $id = $product->id;

        if (is_null($customField)) {
            switch ($product->type) {
                case 'pizza':
                    $customField = 30;
                    break;
            }
        }

        if (key_exists($id, $cart)) {
            foreach ($cart[$id] as $row) {

            }
        }

        session();


        $cart = [];

        $cart[$id] = [
            [
                'count' => 1,
                'type' => 'pizza',
                'custom_field' => 'small',//medium, 30,35,40
            ],
            [
                'count' => 1,
                'type' => 'pizza',
                'custom_field' => 'medium',//medium, 30,35,40
            ]
        ];

        $cart[$id] = [
            'type' => 'wok-soup',
            'custom_field' => 'chicken',//medium, 30,35,40
        ];
    }

    private function createValidateRules($product)
    {
        $validateRules = [];
        /*
        "sizes":
         "25": 2751, "30": 2864, "35": 3019, "40": 4134,
        "fillings":
            {"price": 350, "title": "Моцарелла", "exists": 1}
            {"price": 250, "title": "Острый халапенью", "exists": 1}]
        "sideboard": 1,
        "slim_dough": 1
        */
        foreach ($product->fields as $field => $row) {
            switch ($field) {
                case 'sizes':
                    $validateRules['size'][] = 'required';
                    $validateRules['size'][] = Rule::in(array_keys($row));
                    break;
                case 'slim_dough':
                    break;
                case 'sideboard':
                    if ($row == 0) {
                        $validateRules['sideboard'][] = 'nullable';
                    } else {
                        $validateRules['sideboard'][] = 'boolean';
                    }
                    break;
                case 'fillings':
                    $validateRules['fillings'][] = Rule::in(array_keys($row));
                    break;
            }
        }

        return $validateRules;
    }
}
