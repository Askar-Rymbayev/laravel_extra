<div class="card">
    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->ingredients }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        {{ $product->price }}

        <a class="btn btn-outline-secondary btn-sm" href="{{ route('addToCart', ['id'=>$product->id]) }}" role="button">Добавить</a>
    </div>
</div>
