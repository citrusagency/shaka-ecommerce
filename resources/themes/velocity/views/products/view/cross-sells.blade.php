@foreach ($cart->items as $item)
    <?php
        $product = $item->product;

        if ($product->cross_sells()->count()) {
            $products[] = $product;
            $products = array_unique($products);
        }
    ?>
@endforeach

@if (isset($products))

    <card-list-header
        heading="{{ __('shop::app.products.cross-sell-title') }}"
        view-all="false"
        row-class="pt20"
        class="vc-full-screen w-100"
    ></card-list-header>

    <div class="carousel-products vc-full-screen">
        <carousel-component
            slides-per-page="6"
            navigation-enabled="hide"
            pagination-enabled="hide"
            id="upsell-products-carousel"
            :slides-count="{{ $product->cross_sells()->count() }}">

            @foreach($products as $product)
                @foreach ($product->cross_sells()->paginate(2) as $index => $crossSellProduct)
                    <slide slot="slide-{{ $index }}">
                        @include ('shop::products.list.card', [
                            'product' => $crossSellProduct,
                            'addToCartBtnClass' => 'small-padding',
                        ])
                    </slide>
                @endforeach
            @endforeach
        </carousel-component>
    </div>
@endif