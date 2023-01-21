@extends('shop::layouts.master')

@inject ('productRatingHelper', 'Webkul\Product\Helpers\Review')

@php
    $channel = core()->getCurrentChannel();

    $homeSEO = $channel->home_seo;

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    {{ isset($metaTitle) ? $metaTitle : "" }}
@endsection

@section('head')
    @if (isset($homeSEO))
        @isset($metaTitle)
            <meta name="title" content="{{ $metaTitle }}"/>
        @endisset

        @isset($metaDescription)
            <meta name="description" content="{{ $metaDescription }}"/>
        @endisset

        @isset($metaKeywords)
            <meta name="keywords" content="{{ $metaKeywords }}"/>
        @endisset
    @endif
@endsection

@push('css')
    @if (! empty($sliderData))
        <link rel="preload" as="image" href="{{ Storage::url($sliderData[0]['path']) }}">
    @else
        <link rel="preload" as="image" href="{{ asset('/themes/velocity/assets/images/banner.webp') }}">
    @endif

    <style type="text/css">
        .product-price span:first-child, .product-price span:last-child {
            font-size: 18px;
            font-weight: 600;
        }

        #demo{
            margin-top: -150px;
            /*padding-top: 280px;*/
            /*padding-bottom: 180px;*/
        }
        .homepage-imga, .carousel-item {
            padding-top: 380px;
            padding-bottom: 380px;
            width: 100%;
            {{--background-image: url({{ asset('images/homepage1.png') }});--}}
             background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".carousel").swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (direction == 'left') $(this).carousel('next');
                if (direction == 'right') $(this).carousel('prev');
            },
            allowPageScroll: "vertical"
        });
    </script>
@endpush

{{--@section('content-wrapper')--}}
{{--    @include('shop::home.slider')--}}
{{--@endsection--}}


@section('full-content-wrapper')

    <div class="homepage-img text-white">
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner w-100">
                <div class="carousel-item active" style="background-image: url({{ asset('images/homepage2.png') }});">
                    <div class="container">
                        <p class="text-uppercase" style="letter-spacing: 3px">Shaka & Katarina Zlajić</p>
                        <h1 class="heading-1 font-weight-normal mb-5">Shop extravagant <br>jewelry and clothes</h1>
                        <button class="btn bg-shaka-primary btn-lg px-5">Shop now</button>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
{{--            <a class="carousel-control-prev" href="#demo" data-slide="prev">--}}
{{--                <span class="carousel-control-prev-icon"></span>--}}
{{--            </a>--}}
{{--            <a class="carousel-control-next" href="#demo" data-slide="next">--}}
{{--                <span class="carousel-control-next-icon"></span>--}}
{{--            </a>--}}
        </div>
        {{--        @include('shop::home.slider')--}}
        {{--        <div class="container">--}}
        {{--            <h1 class="heading-1 font-weight-bold">Shaka & <br> Katarina Zlajić</h1>--}}
        {{--            <p>Extravagant clothes and jewelry pieces.</p>--}}
        {{--            <button class="btn bg-shaka-primary btn-lg px-5">Shop now</button>--}}
        {{--        </div>--}}
    </div>

    <div class="bg-shaka-darker py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-0">
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                            <img src="{{ asset('images/vegan.svg') }}" class="" alt="">
                            <p class="text-white text-center mt-2">Vegan</p>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                            <img src="{{ asset('images/handmade.svg') }}" alt="">
                            <p class="text-white text-center mt-2">Handmade</p>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">
                            <img src="{{ asset('images/sustainable.svg') }}" alt="">
                            <p class="text-white text-center mt-2">Sustainable</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-shaka-light py-5">
        <div class="container">
            <h2 class="text-center text-white text-shaka-black  heading-2 h1 mt-5 mb-5">
                Shop by collection
            </h2>
            <br>
            <div class="row mt-4">
                <div class="col-md-6 col-sm-12 collection">
                    <a href="#">
                    <img src="{{ asset('images/collection1.png') }}" class="w-100 mt-3" alt="">
                    <div class="bg-shaka-black px-4 py-2 text-white text-uppercase collection-title" style="letter-spacing: 2px">Katarina Zlajić</div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 collection">
                    <a href="#">
                        <img src="{{ asset('images/collection2.png') }}" class="w-100 mt-3" alt="">
                        <div class="bg-shaka-black px-4 py-2 text-white text-uppercase collection-title" style="letter-spacing: 2px">Shaka</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="full-content-wrapper container">
        <!-- {!! view_render_event('bagisto.shop.home.content.before') !!} -->


        <!-- @include('shop::home.advertisements.advertisement-four') -->
{{--        @include('shop::home.featured-products')--}}
        <!-- @include('shop::home.advertisements.advertisement-three') -->
        @include('shop::home.new-products')
        <!-- @include('shop::home.advertisements.advertisement-two') -->

        {{ view_render_event('bagisto.shop.home.content.after') }}
    </div>

@endsection

