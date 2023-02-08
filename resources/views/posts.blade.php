@extends('layout')

@section('title')
    Posts
@endsection

@section('header')
    Posts
@endsection

@section('content')
    <div>
        <a href="/posts/create">Create New Post</a>
    </div>

    @foreach ($posts as $post)
        <article class="{{ $loop->even ? 'bg-info' : '' }} {{ $post->trashed() ? 'bg-danger' : '' }}">
            <h1><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h1>
            <div>{{ $post->descr }}</div>
        </article>
    @endforeach
@endsection
