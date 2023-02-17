<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use \App\Http\Controllers\PostController;

use \Illuminate\Support\Facades\File;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
//    $cart = session('cart');
//    if (!is_array($cart)) {
//        session()->put('cart', []);
//    }
//    session()->put('test1', 1);
//    session(['two'=>2]);
//    session()->put('null_value', true);
    echo '<pre>';

//    $productId = 3;
//    $command = 'increment';
//    $cartProductKey = 'cart.' . $productId . '.0.count';
//
//    var_dump($cartProductKey);
//
//    if (session()->has($cartProductKey)) {
//        if ($command == 'increment') {
//            session()->increment($cartProductKey);
//        } elseif ($command == 'decrement') {
//            session()->decrement($cartProductKey);
//        }
//    }

//    $data = [
//        'product_id' => 1,
//        'count' => 2,
//    ];
//    $cartKey = 'cart.' . $data['product_id'];
//
//    if (session()->has('cart.' . $data['product_id'] . '.0')) {
//        return 'ok';
//    } else {
//        session()->push($cartKey, $data);
//    }


//    session()->flash('flash_data_1', 100);
//    session()->flash('flash_data_2', 200);
//    session()->flash('flash_data_3', 300);
//    session()->keep('flash_data_2');
//    session()->reflash();

//    session()->forget(['null_value', 'test1', 'two']);
    session()->flush();



//    dd($request->session()->all());

//    var_dump(session()->get('cart'));

//    var_dump(session()->all());
//    $test1 = session()->pull($cartKey);
//    var_dump($test1);
    var_dump(session()->all());

//    var_dump(session()->has('null_value'));
//    var_dump(session()->missing('null_value'));
//    var_dump(session()->exists('null_value'));
    echo '</pre>';
//    session(['cart'=>[]]);
//    dd($session);
    return 'done';
});

Route::get('/set_cookie', function (Request $request) {
    $minutes = 3;
    $response = new Response('Set Cookie');
    $response->withCookie(cookie()->forever('userToken', md5('sdfs')));

    return $response;
});

Route::get('/get_cookie', function (Request $request) {
    $value = $request->cookie('userToken');

    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    return 'done';
});

Route::resource('posts', PostController::class)->withTrashed();
Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');

Route::get('/category/{category:slug}/posts', function (\App\Models\Category $category) {
    return view("categories.posts", ['category' => $category]);
});

//Route::get('/photos', [PostController::class, 'index']);
//Route::get('/photos/create', [PostController::class, 'create']);
//Route::post('/photos', [PostController::class, 'store']);
//Route::get('/photos/{photo}', [PostController::class, 'show']);
//Route::get('/photos/{photo}', [PostController::class, 'show']);
//Route::get('/photos/{photo}/edit', [PostController::class, 'edit']);
//Route::put('/photos/{photo}', [PostController::class, 'update']);
//Route::delete('/photos/{photo}', [PostController::class, 'destroy']);

//Route::get('/', function () {
//    return view("posts", ['posts' => Post::all()]);
//});
//
//Route::get('/post/{post}', function (Post $post) {
//    return view("post", ['post' => $post]);
//});
//
//Route::get('/test', function () {
//    $users = \App\Models\User::with('posts')->get();
//    return view('test', ['users' => $users]);
//});
