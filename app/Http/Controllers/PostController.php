<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view("posts", ['posts' => Post::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('post_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $post = Post::create(array_merge($request->all(), ['author_id' => 1]));

        return redirect('/posts/' . $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     */
    public function show(Post $post)
    {
        return view("post", ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     */
    public function edit(Post $post)
    {
        return view('post_edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     */
    public function update(Request $request, Post $post)
    {
        $post->fill($request->all());
        $post->save();

        return redirect('/posts/' . $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }

    public function restore(Post $post)
    {
        $post->restore();

        return redirect('/posts/' . $post->slug);
    }
}
