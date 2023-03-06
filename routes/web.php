<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use \App\Http\Controllers\PostController;

use \Illuminate\Support\Facades\File;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;


Route::resource('posts', PostController::class)->withTrashed();
Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');

Route::get('/category/{category:slug}/posts', function (\App\Models\Category $category) {
    return view("categories.posts", ['category' => $category]);
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/test', function () {
//    return view('test');
//});
//Route::post('/test', function (Request $request) {
//    $path = $request->file('file')->store('products');
//    return $path;
//});
