@extends('layouts.app')

@section('top_menu')
    <x-menu :$categories :id="0"/>
@endsection

@section('content')
    <p>Landing page</p>
@endsection


