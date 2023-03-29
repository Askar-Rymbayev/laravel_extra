@extends('layouts.app')

@section('top_menu')
    <x-menu :$categories/>
@endsection

@section('content')
    <x-products.products-list :$products/>
@endsection


