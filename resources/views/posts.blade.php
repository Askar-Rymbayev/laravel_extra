@extends('layout')

@section('title')
    Posts
@endsection

@section('header')
    Posts
@endsection

@section('content')
    @foreach ($posts as $post)
        <article class="{{ $loop->even ? 'bg-info' : '' }}">
            <h1><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></h1>
            <div>{{ $post->descr }}</div>
        </article>
    @endforeach
@endsection
