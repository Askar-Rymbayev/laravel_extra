<div class="row">
    <div class="col">
        <div class="alert alert-warning" role="alert">
            <pre>
            @php
                print_r($cart);
            @endphp
            </pre>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            @switch($product->type)
                @case('pizza')
                    <x-products.pizza :$product/>
                    @break

                @case('soup')
                @case('wok')
                    <x-products.wok-soup :$product/>
                    @break

                @default
                    <x-products.default-product :$product/>
            @endswitch
        </div>
    @endforeach
</div>
