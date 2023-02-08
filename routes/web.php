<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use \App\Http\Controllers\PostController;

use \Illuminate\Support\Facades\File;
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

Route::resource('posts', PostController::class)->withTrashed();
Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');

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
