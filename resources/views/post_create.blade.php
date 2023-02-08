@extends('layout')

@section('title')
    Create New Post
@endsection

@section('header')
    Create New Post
@endsection

@section('content')
    <form action="/posts" method="post">
        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label> <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="descr" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label> <textarea name="body" class="form-control" rows="8"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    </form>
@endsection
