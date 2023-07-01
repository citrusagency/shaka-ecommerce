<?php
    $relatedProductss = $product->related_products()->get();
//    dd($relatedProducts[0]->product_flats[0], $product);
//dd($relatedProducts->count())
?>
<style>

</style>
@if ($relatedProducts->count())
    <div class="titlebaby1">

    <card-list-header
        heading="{{ __('shop::app.products.related-product-title') }}"
        view-all="false"
        row-class="pt20"
        class="font-shaka-noto-serif titlebaby"
    ></card-list-header>
        <p class="pb-5 text-shaka-subtitle">Browse the collection of our related products.
        </p>
    </div>

    <div class="carousel-products vc-full-screen">
        <carousel-component
            slides-per-page="4"
            navigation-enabled="hide"
            pagination-enabled="hide"
            id="related-products-carousel"
            :slides-count="{{ sizeof($relatedProducts) }}">

            @foreach ($relatedProducts as $index => $relatedProduct)
{{--                {{ dd($relatedProduct) }}--}}
                <slide slot="slide-{{ $index }}">
{{--                    @include ('shop::products.list.card', [--}}
{{--                        'product' => $relatedProduct,--}}
{{--                        'addToCartBtnClass' => 'small-padding',--}}
{{--                    ])--}}
{{--                    {{ dd($relatedProduct) }}--}}

                    <product-card
                        :list="false"
                        :product="{{ json_encode($relatedProduct)  }}">
                    </product-card>
                </slide>
            @endforeach
        </carousel-component>
    </div>

{{--    <div class="carousel-products vc-small-screen">--}}
{{--        <carousel-component--}}
{{--            :slides-count="{{ sizeof($relatedProducts) }}"--}}
{{--            slides-per-page="2"--}}
{{--            id="related-products-carousel"--}}
{{--            navigation-enabled="hide"--}}
{{--            pagination-enabled="hide">--}}

{{--            @foreach ($relatedProducts as $index => $relatedProduct)--}}
{{--                <slide slot="slide-{{ $index }}">--}}
{{--                    @include ('shop::products.list.card', [--}}
{{--                        'product' => $relatedProduct,--}}
{{--                        'addToCartBtnClass' => 'small-padding',--}}
{{--                    ])--}}
{{--                </slide>--}}
{{--            @endforeach--}}
{{--        </carousel-component>--}}
{{--    </div>--}}
@endif