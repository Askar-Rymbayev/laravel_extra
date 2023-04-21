@extends('layouts.app')

@section('top_menu')
    <x-menu :$categories :$id/>
@endsection

@section('breadcrumb')
    <x-breadcrumb :$breadcrumb/>
@endsection

@section('content')
    <h3>{{ $category->title }}</h3>
    <x-products.products-list :$products :$cart/>
@endsection


