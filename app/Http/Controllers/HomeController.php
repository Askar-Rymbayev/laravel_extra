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
        $categories = Category::all();

        return view('home', ['categories' => $categories]);
    }

    public function category($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();

        return view('category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
