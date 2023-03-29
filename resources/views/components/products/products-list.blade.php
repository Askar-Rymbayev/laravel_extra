<div class="row">
    @foreach($products as $product)
        <div class="col-3">
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
