@extends('layout')

@section('title')
    Create New Post
@endsection

@section('header')
    Create New Post
@endsection

@section('content')

    <form action="/posts" method="post" class="">
        <div class="mb-3">
            <label class="form-label">ЧПУ (ссылка)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}">

            @if($errors->has('slug'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('slug') as $message)
                        {{ $message }}
                        @if($loop->count > 1 && !$loop->last)
                            <br>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

            @if($errors->has('title'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('title') as $message)
                        {{ $message }}
                        @if($loop->count > 1 && !$loop->last)
                            <br>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="descr" class="form-control {{ $errors->has('descr') ? 'is-invalid' : '' }}" rows="3">{{ old('descr') }}</textarea>

            @if($errors->has('descr'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('descr') as $message)
                        {{ $message }}
                        @if($loop->count > 1 && !$loop->last)
                            <br>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="8">{{ old('body') }}</textarea>

            @if($errors->has('body'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('body') as $message)
                        {{ $message }}
                        @if($loop->count > 1 && !$loop->last)
                            <br>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    </form>
@endsection
