<?php
    $relatedProductss = $product->related_products()->get();
?>
<style>

</style>
@if ($relatedProducts->count())
    <div class="titlebaby1 d-flex justify-content-center row">
        <card-list-header
            heading="{{ __('shop::app.products.related-product-title') }}"
            view-all="false"
            row-class="pt20"
            class="font-shaka-noto-serif titlebaby"
        ></card-list-header>
        <p class="pb-5 text-shaka-subtitle text-center">
            Browse the collection of our related products.
        </p>
    </div>

    <div class="carousel-products" >
{{--        <carousel-component--}}
{{--            slides-per-page="4"--}}
{{--            navigation-enabled="hide"--}}
{{--            pagination-enabled="hide"--}}
{{--            id="related-products-carousel"--}}
{{--            :slides-count="{{ sizeof($relatedProducts) }}">--}}
{{--            @foreach ($relatedProducts as $index => $relatedProduct)--}}
{{--                    <slide slot="slide-{{ $index }}" class="d-flex justify-content-center flex-wrap">--}}
{{--                            @include ('shop::products.list.card', [--}}
{{--                                'product' => $relatedProduct,--}}
{{--                                'addToCartBtnClass' => 'small-padding',--}}
{{--                            ])--}}
{{--                        <product-card--}}
{{--                            :list="false"--}}
{{--                            :product="{{ json_encode($relatedProduct)  }}">--}}
{{--                        </product-card>--}}
{{--                    </slide>--}}
{{--            @endforeach--}}
{{--        </carousel-component>--}}

        <div class="d-flex justify-content-between flex-row flex-wrap m-auto ">
            @foreach ($relatedProducts as $index => $relatedProduct)
                <div class="m-auto">
                    <product-card
                        :list="false"
                        :product="{{ json_encode($relatedProduct)  }}">
                    </product-card>
                </div>
            @endforeach
        </div>
    </div>

{{--    <div class="carousel-products ">--}}
{{--        <carousel-component--}}
{{--            :slides-count="{{ sizeof($relatedProducts) }}"--}}
{{--            slides-per-page="2"--}}
{{--            id="related-products-carousel"--}}
{{--            navigation-enabled="hide"--}}
{{--            pagination-enabled="hide">--}}

{{--            @foreach ($relatedProducts as $index => $relatedProduct)--}}
{{--                <slide slot="slide-{{ $index }}">--}}
{{--                    --}}{{--                    @include ('shop::products.list.card', [--}}
{{--                    --}}{{--                        'product' => $relatedProduct,--}}
{{--                    --}}{{--                        'addToCartBtnClass' => 'small-padding',--}}
{{--                    --}}{{--                    ])--}}
{{--                    <product-card--}}
{{--                        :list="false"--}}
{{--                        :product="{{ json_encode($relatedProduct)  }}">--}}
{{--                    </product-card>--}}
{{--                </slide>--}}
{{--            @endforeach--}}
{{--        </carousel-component>--}}
{{--    </div>--}}
@endif