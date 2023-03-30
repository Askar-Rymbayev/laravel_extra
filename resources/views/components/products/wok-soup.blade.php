<div class="card text-bg-info" style="width: 18rem;">
    <img src="{{ $product->image }}" height="200" class="card-img-top" alt="{{ $product->title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->ingredients }}</p>
    </div>
    <div class="card-footer">
        {{ $product->price }}
    </div>
</div>
