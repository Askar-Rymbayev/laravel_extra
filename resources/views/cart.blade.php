@extends('layouts.app')

@section('top_menu')
    <x-menu :$categories :id="0"/>
@endsection

@section('breadcrumb')
    <x-breadcrumb :$breadcrumb/>
@endsection

@section('content')
    <h3>Корзина</h3>

    @foreach($cart as $productId => $productParams)
        @php
            $product = $products->find($productId);
        @endphp
        @foreach($productParams as $params)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $product->title }}
                </div>
                <div class="card-body">
                    <img src="{{ $product->image }}" class="img-thumbnail img-fluid rounded-start">
                    <p class="card-text">
                        {{ $params['ingredients'] }}
                    </p>
                </div>
                <div class="card-footer">
                    {{ $params['total_sum'] }} тенге
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
