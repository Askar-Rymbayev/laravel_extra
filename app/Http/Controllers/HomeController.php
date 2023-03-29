<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();

        return view('home', ['categories' => $categories]);
    }

    public function category($id)
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();

        $category = Category::findOrFail($id);
        $ids[] = $category->id;
        if (!is_null($category->subcategories)) {
            foreach ($category->subcategories as $subcategory) {
                $ids[] = $subcategory->id;
            }
        }

        $products = Product::whereIn('category_id', $ids)->get();

        return view('category', [
            'id' => $id,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
