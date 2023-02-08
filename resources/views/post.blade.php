@extends('layout')

@section('header')
    Post: {{ $post->title }}
@endsection

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div>
        {!! $post->body !!}
    </div>

    @if(!$post->trashed())
        <form action="/posts/{{ $post->slug }}" method="post">
            @method('DELETE')
            <button type="submit" class="btn btn-primary">delete</button>

            @csrf
        </form>
    @else
        <a href="/posts/{{ $post->slug }}/restore">restore</a><br>
    @endif
    <a href="/posts/{{ $post->slug }}/edit">edit</a><br>
    <a href="/posts">back</a>
@endsection
