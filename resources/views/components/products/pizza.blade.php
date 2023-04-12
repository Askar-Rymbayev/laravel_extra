<form action="{{ route('addToCart') }}" method="post" class="card">
    @csrf

    <input type="hidden" name="id" value="{{ $product->id }}">

    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->ingredients }}</p>

        <div class="btn-group btn-group-sm mb-1" role="group">
            @foreach($product->fields['sizes'] as $size => $price)
                <input type="radio" class="btn-check" name="size" id="btnradio{{ $size }}_{{ $product->id }}" value="{{ $size }}" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio{{ $size }}_{{ $product->id }}">{{ $size }} см</label>
            @endforeach
        </div>

        <div class="btn-group btn-group-sm mb-1" role="group">
            <input type="radio" class="btn-check" name="dough" id="dough_traditional_{{ $product->id }}" value="1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="dough_traditional_{{ $product->id }}">Традиционное</label>

            @if($product->fields['slim_dough'])
                <input type="radio" class="btn-check" name="dough" id="dough_slim_{{ $product->id }}" value="2" autocomplete="off">
                <label class="btn btn-outline-primary" for="dough_slim_{{ $product->id }}">Тонкое</label>
            @endif
        </div>

        @if($product->fields['sideboard'])
            <div class="form-check mb-1">
                <input class="form-check-input" type="checkbox" name="sideboard" value="1" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Сырный бортик</label>
            </div>
        @endif

        @if(key_exists('fillings', $product->fields) && !empty($product->fields['fillings']))
            @foreach($product->fields['fillings'] as $index => $row)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fillings" value="{{ $index }}" role="switch" id="fillings_{{ $index }}">
                    <label class="form-check-label" for="fillings_{{ $index }}">{{ $row['title'] }} - {{ $row['price'] }} тг.</label>
                </div>
            @endforeach
        @endif

    </div>
    <div class="card-footer d-flex justify-content-between">
        {{ $product->price }}

        <a class="btn btn-outline-secondary btn-sm" id="prduct-{{ $product->id }}" href="{{ route('addToCart', ['id'=>$product->id]) }}" role="button">Добавить</a>
    </div>
</form>


