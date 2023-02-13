@extends('layout')

@section('title')
    Category Posts
@endsection

@section('header')
    Posts of {{ $category->title }}
@endsection

@section('content')
    @foreach ($category->posts as $post)
        <article class="mt-3 {{ $post->trashed() ? 'bg-danger' : '' }}">
            <h1><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h1>
            <div>{{ $post->descr }}</div>
        </article>
    @endforeach
@endsection
