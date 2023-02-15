@extends('layout')

@section('title')
    Edit Post
@endsection

@section('header')
    Edit Post
@endsection

@section('content')
    <form action="/posts/{{ $post->slug }}" method="post">
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" value="{{ $post->slug }}" class="form-control">
            <p>{{ old('slug') }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label> <input type="text" name="title" value="{{ $post->title }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="descr" class="form-control" rows="3">{{ $post->descr }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label> <textarea name="body" class="form-control" rows="8">{{ $post->body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        @csrf
    </form>
@endsection
