@extends('layout')

@section('header')
    Post: {{ $post->title }}
@endsection

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div>
        {!! $post->body  !!}
    </div>

    <a href="/">back</a>
@endsection
