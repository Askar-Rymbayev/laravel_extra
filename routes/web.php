<?php

/*
1. страница корзины. кол-во, удалить
2. создать миграцию для таблицы заказов
3. оформление заказа
4. отправка почты клиенту, о заказе
*/

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'category']);

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

//Route::resource('posts', PostController::class)->withTrashed();
//Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');
//
//Route::get('/category/{category:slug}/posts', function (\App\Models\Category $category) {
//    return view("categories.posts", ['category' => $category]);
//});
//
//Auth::routes();
//
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/test', function () {
//    return view('test');
//});
//Route::post('/test', function (Request $request) {
//    $path = $request->file('file')->store('products');
//    return $path;
//});
