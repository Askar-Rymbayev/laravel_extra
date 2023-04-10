<div class="card">
    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->ingredients }}</p>

        <div class="btn-group btn-group-sm" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio_{{ $product->id }}" data-productid="{{ $product->id }}" id="btnradio1_{{ $product->id }}" value="25" autocomplete="off"> <label class="btn btn-outline-primary" for="btnradio1_{{ $product->id }}">25 см</label>
            <input type="radio" class="btn-check" name="btnradio_{{ $product->id }}" data-productid="{{ $product->id }}" id="btnradio2_{{ $product->id }}" value="30" autocomplete="off"> <label class="btn btn-outline-primary" for="btnradio2_{{ $product->id }}">30 см</label>
            <input type="radio" class="btn-check" name="btnradio_{{ $product->id }}" data-productid="{{ $product->id }}" id="btnradio3_{{ $product->id }}" value="35" autocomplete="off"> <label class="btn btn-outline-primary" for="btnradio3_{{ $product->id }}">35 см</label>
        </div>

    </div>
    <div class="card-footer d-flex justify-content-between">
        {{ $product->price }}

        <a class="btn btn-outline-secondary btn-sm" id="prduct-{{ $product->id }}" href="{{ route('addToCart', ['id'=>$product->id]) }}" role="button">Добавить</a>
    </div>
</div>


