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

<script>
    $(function () {
        $(".btn-check").click(function(){
            let productId = $(this).data('productid');
            let value = $(this).val();

            let link = $('#prduct-' + productId);
            let href = link.attr('href');

            if (href.indexOf('?') === -1) {
                link.attr('href', href + '?custom_field=' + value)
            } else {
                link.attr('href', href.substr(0, href.indexOf('?')) + '?custom_field=' + value)
            }
        });
    });
</script>
