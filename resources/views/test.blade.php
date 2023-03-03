@extends('layout')

@section('content')
    <form action="/test" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file">
        <button>submit</button>
    </form>
@endsection
