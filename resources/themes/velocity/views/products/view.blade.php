@extends('shop::layouts.master')

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')

@php
    $total = $reviewHelper->getTotalReviews($product);

    $avgRatings = $reviewHelper->getAverageRating($product);
    $avgStarRating = round($avgRatings);

    $productImages = [];
    $images = productimage()->getGalleryImages($product);

    foreach ($images as $key => $image) {
        array_push($productImages, $image['medium_image_url']);
    }
@endphp

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description"
          content="{{ trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}"/>

    <meta name="keywords" content="{{ $product->meta_keywords }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) !!}
        </script>
    @endif

    <?php $productBaseImage = productimage()->getProductBaseImage($product, $images); ?>

    <meta name="twitter:card" content="summary_large_image"/>

    <meta name="twitter:title" content="{{ $product->name }}"/>

    <meta name="twitter:description" content="{{ $product->description }}"/>

    <meta name="twitter:image:alt" content=""/>

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}"/>

    <meta property="og:type" content="og:product"/>

    <meta property="og:title" content="{{ $product->name }}"/>

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}"/>

    <meta property="og:description" content="{{ $product->description }}"/>

    <meta property="og:url" content="{{ route('shop.productOrCategory.index', $product->url_key) }}"/>
@stop

@push('css')
    <style type="text/css">
        .related-products {
            width: 100%;
        }

        .recently-viewed {
            margin-top: 20px;
        }

        .store-meta-images > .recently-viewed:first-child {
            margin-top: 0px;
        }

        .main-content-wrapper {
            margin-bottom: 0px;
        }

        .buynow {
            height: 40px;
            text-transform: uppercase;
        }

        .gg img {
            aspect-ratio: 4/5 !important;
            width: 100% !important;
            object-fit: cover !important;
        }

        .single-price {
            font-family: 'Open Sans', sans-serif !important;
            font-size: 1.5rem !important;
            font-weight: 400 !important;
        }

        .quantity .actions .add-to-cart-btn button {
            background: #1197C2 !important;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .actions {
            gap: 1rem;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-content: flex-end;
            align-items: flex-end;
            justify-content: space-between;
        }
        body {
            overflow-x: hidden!important;
        }
        .titlebaby1 .titlebaby div h2 {
            font-weight: 400!important;
            font-size: 1.8rem!important;
        }
        .galop {
            background-color: #FAFAFA!important;
            display: grid;
            place-items: center;
        }

        .quantity .actions .add-to-cart-btn button.notify-available{
            background: #B84626!important;
            color: #fff!important;
            border-radius: 5px!important;
            border: none!important;
        }
    </style>
@endpush

@section('content-wrapper')
{{--    {{ dd($relatedProducts) }}--}}
    <div class="container pt-4">
        <p>HOME > SHOP > {{ $product->name }}</p>
        {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}
        <div class="row no-margin container">
            <section class="col-12 product-detail">
                <div class="layouter">
                    <product-view>

                        <div class="form-container">
                            @csrf()

                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                            <div class="row">
                                {{-- product-gallery --}}
                                <div class="left col-lg-5 col-md-6 gg">
                                    @include ('shop::products.view.gallery')
                                </div>

                                {{-- right-section --}}
                                <div class="right col-lg-7 col-md-6">
                                    {{-- product-info-section --}}
                                    <div class="info">
                                        <h2 class="col-12 pb-0 mb-0 font-shaka-noto-serif"
                                            style="font-weight: 400!important;font-size: 2rem; line-height: 1.9rem;">{{ $product->name }}</h2>

                                        {{--                                        @if ($total)--}}
                                        {{--                                            <div class="reviews col-lg-12">--}}
                                        {{--                                                <star-ratings--}}
                                        {{--                                                    push-class="mr5"--}}
                                        {{--                                                    :ratings="{{ $avgStarRating }}"--}}
                                        {{--                                                ></star-ratings>--}}

                                        {{--                                                <div class="reviews">--}}
                                        {{--                                                    <span>--}}
                                        {{--                                                        {{ __('shop::app.reviews.ratingreviews', [--}}
                                        {{--                                                            'rating' => $avgRatings,--}}
                                        {{--                                                            'review' => $total])--}}
                                        {{--                                                        }}--}}
                                        {{--                                                    </span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endif--}}

                                        {{--                                        @include ('shop::products.view.stock', ['product' => $product])--}}

                                        <div class="col-12 price font-shaka-open-sans">

                                            @include ('shop::products.price', ['product' => $product])

                                            @if (
                                                Webkul\Tax\Helpers\Tax::isTaxInclusive()
                                                && $product->getTypeInstance()->getTaxCategory()
                                            )
                                                <span>
                                                    {{ __('velocity::app.products.tax-inclusive') }}
                                                </span>
                                            @endif
                                        </div>

                                        @include ('shop::products.view.description')


                                        @if (count($product->getTypeInstance()->getCustomerGroupPricingOffers()) > 0)
                                            <div class="col-12">
                                                @foreach ($product->getTypeInstance()->getCustomerGroupPricingOffers() as $offers)
                                                    {{ $offers }} </br>
                                                @endforeach
                                            </div>
                                        @endif

                                        <hr>


                                        <div class="options-section py-2">
                                            <h6 class="font-shaka-open-sans" style="font-weight: 600">Available
                                                options</h6>
                                            <div class="stock py-2">
                                                <div class="col-12 availability">
                                                    @if($product->haveSufficientQuantity(1) === true)
                                                        <div>
                                                            <img src="{{asset('images/check.svg')}}" alt=""> <span
                                                                class="pl-2">{{ $product->totalQuantity() }} in stock</span>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <img src="{{asset('images/close.svg')}}" alt=""> out of
                                                            stock
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="quantity py-4 md:py-2">
                                                {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                                                @if ($product->getTypeInstance()->showQuantityBox())
                                                    <div class="col-12 actions">
                                                        @if($product->isSaleable())
                                                        <quantity-changer
                                                            quantity-text="{{ __('shop::app.products.quantity') }}"></quantity-changer>
                                                        @endif
                                                        <div>
                                                            @if (core()->getConfigData('catalog.products.storefront.buy_now_button_display'))
                                                                @include ('shop::products.buy-now', [
                                                                    'product' => $product,
                                                                ])
                                                            @endif

                                                            @include ('shop::products.add-to-cart-product', [
                                                                'form' => false,
                                                                'product' => $product,
                                                                'showCartIcon' => false,
                                                                'showCompare' => core()->getConfigData('general.content.shop.compare_option') == "1"
                                                                                ? true : false,
                                                            ])
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="quantity" value="1">
                                                @endif

                                                {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}

                                                <div class="col-12 pt-3 text-left d-flex">
                                                    <div class="p-0 pr-2 pt-1">

                                                        @include('shop::products.wishlist-product', [
                                                            'addClass' => $addWishlistClass ?? ''
                                                        ])

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>
                                        <div class="details-section py-2">
                                            <p>CATEGORY:
                                                <span class="text-uppercase text-shaka-primary">
            {{ $product->product->categories->implode('name', ', ') }}
        </span>
                                            </p>
                                            <div class="pt-3 d-flex align-content-center"
                                                 style="display: flex!important; align-items: flex-end;">
                                                <p>SHARE THIS PRODUCT:</p>
                                                <div class="d-flex gap-2" style="gap: 10px">
            <span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                   target="_blank">
                    <img src="{{asset('images/Facebook.svg')}}" alt="">
                </a>
            </span>
                                                    <span>
                <a href="fb-messenger://share?link={{ urlencode(Request::fullUrl()) }}" target="_blank">
                    <img src="{{asset('images/Messenger.svg')}}" alt="">
                </a>
            </span>
                                                    <span>
                <a href="https://twitter.com/share?url={{ urlencode(Request::fullUrl()) }}&text={{ $product->name }}&via=YourTwitterUsername"
                   target="_blank">
                    <img src="{{asset('images/Twitter.svg')}}" alt="">
                </a>
            </span>
                                                    <span>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}&title={{ $product->name }}&source={{ config('app.url') }}"
                   target="_blank">
                    <img src="{{asset('images/Linkedin.svg')}}" alt="">
                </a>
            </span>
                                                    <span>
                <a href="#"
                   onclick="event.preventDefault(); navigator.clipboard.writeText('{{ Request::fullUrl() }}'); alert('Link copied to clipboard!');">
                    <img src="{{asset('images/Link45deg.svg')}}" alt="">
                </a>
            </span>
                                                </div>
                                            </div>
                                        </div>


                                        {{--                                        @include ('shop::products.view.configurable-options')--}}

                                        {{--                                        @include ('shop::products.view.downloadable')--}}

                                        {{--                                        @include ('shop::products.view.grouped-products')--}}

                                        {{--                                        @include ('shop::products.view.bundle-options')--}}

                                        {{--                                        <div class="col-12 product-actions">--}}
                                        {{--                                            @if (core()->getConfigData('catalog.products.storefront.buy_now_button_display'))--}}
                                        {{--                                                @include ('shop::products.buy-now', [--}}
                                        {{--                                                    'product' => $product,--}}
                                        {{--                                                ])--}}
                                        {{--                                            @endif--}}

                                        {{--                                            @include ('shop::products.add-to-cart', [--}}
                                        {{--                                                'form' => false,--}}
                                        {{--                                                'product' => $product,--}}
                                        {{--                                                'showCartIcon' => false,--}}
                                        {{--                                                'showCompare' => core()->getConfigData('general.content.shop.compare_option') == "1"--}}
                                        {{--                                                                ? true : false,--}}
                                        {{--                                            ])--}}
                                        {{--                                        </div>--}}
                                    </div>

                                    {{--                                    @include ('shop::products.view.short-description')--}}



                                    {{-- product long description --}}
                                    {{--                                    @include ('shop::products.view.description')--}}

                                    {{-- reviews count --}}
                                    {{--                                    @include ('shop::products.view.reviews', ['accordian' => true])--}}
                                </div>
                            </div>
                        </div>
                    </product-view>

                </div>



            </section>
            @if($product->product->washing_tips || $product->product->specifications || $product->product->delivery)
            <div class="specs w-100 mt-5">
                <product-specs :product="{{ $product }}"></product-specs>
            </div>
            @endif

            @if($product->product->galop_sticker)
                <div class="galop w-100 mt-5 py-5">
                    <img src="{{asset("images/galop.png")}}" alt="">
                </div>
                @endif

            <div class="related-products mt-5">
                @if($relatedProducts->count())
                <div class="bg-shaka-light py-5" style="    width: 121%;
    margin-left: -10%;
    padding-left: 10%;
    overflow: hidden;">

                @include('shop::products.view.related-products', ['relatedProducts' => $relatedProducts])
                </div>
                @endif
                @include('shop::products.view.up-sells')
            </div>

        </div>
        {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

    <script type="text/javascript" src="{{ asset('themes/velocity/assets/js/jquery-ez-plus.js') }}"></script>

    <script type='text/javascript' src='https://unpkg.com/spritespin@4.1.0/release/spritespin.js'></script>

    <script type="text/x-template" id="product-view-template">
        <form
            method="POST"
            id="product-form"
            @click="onSubmit($event)"
            @submit.enter.prevent="onSubmit($event)"
            action="{{ route('cart.add', $product->product_id) }}"
        >
            <input type="hidden" name="is_buy_now" v-model="is_buy_now">

            <slot v-if="slot"></slot>

            <div v-else>
                <div class="spritespin"></div>
            </div>
        </form>
    </script>

    <script>
        Vue.component('product-view', {
            inject: ['$validator'],
            template: '#product-view-template',
            data: function () {
                return {
                    slot: true,
                    is_buy_now: 0,
                }
            },

            mounted: function () {
                let currentProductId = '{{ $product->url_key }}';
                let existingViewed = window.localStorage.getItem('recentlyViewed');

                if (!existingViewed) {
                    existingViewed = [];
                } else {
                    existingViewed = JSON.parse(existingViewed);
                }

                if (existingViewed.indexOf(currentProductId) == -1) {
                    existingViewed.push(currentProductId);

                    if (existingViewed.length > 3)
                        existingViewed = existingViewed.slice(Math.max(existingViewed.length - 4, 1));

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(existingViewed));
                } else {
                    var uniqueNames = [];

                    $.each(existingViewed, function (i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });

                    uniqueNames.push(currentProductId);

                    uniqueNames.splice(uniqueNames.indexOf(currentProductId), 1);

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(uniqueNames));
                }
            },

            methods: {
                onSubmit: function (event) {
                    if (event.target.getAttribute('type') != 'submit')
                        return;

                    event.preventDefault();

                    this.$validator.validateAll().then(result => {
                        if (result) {
                            this.is_buy_now = event.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function () {
                                document.getElementById('product-form').submit();
                            }, 0);
                        } else {
                            this.activateAutoScroll();
                        }
                    });
                },

                activateAutoScroll: function (event) {

                    /**
                     * This is normal Element
                     */
                    const normalElement = document.querySelector(
                        '.control-error:first-of-type'
                    );

                    /**
                     * Scroll Config
                     */
                    const scrollConfig = {
                        behavior: 'smooth',
                        block: 'end',
                        inline: 'nearest',
                    }

                    if (normalElement) {
                        normalElement.scrollIntoView(scrollConfig);
                        return;
                    }
                }
            }
        });

        window.onload = function () {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {
                for (let i = 0; i < thumbFrame.length; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function () {
                if (thumbList && productHeroImage) {

                    for (let i = 0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };
    </script>
@endpush