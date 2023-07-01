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

        #demo {
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
        .subscribe {
            height: 62px;
            width: 100%;

        }
        .subscribe input{
            height: 100%;
            background: #FFFFFF;
            /* Stroke color */
            padding: 5px 20px;
            border: 1px solid #A9A9A9;
        }
        .subscribe button {
            height: 100%;
            display: inline-block;
            border: none;
            padding: 0 20px;
        }

        .collection a:hover .titlovi {
            background-color: #090909!important;
            color: #fff!important;
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
                        <div class="bg-shaka-light px-4 py-2 text-shaka-black text-uppercase collection-title titlovi"
                             style="letter-spacing: 2px">Katarina Zlajić
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 collection">
                    <a href="#">
                        <img src="{{ asset('images/collection2.png') }}" class="w-100 mt-3" alt="">
                        <div class="bg-shaka-light px-4 py-2 text-shaka-black text-uppercase collection-title titlovi"
                             style="letter-spacing: 2px">Shaka
                        </div>
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

    <div class="d-block d-md-none mt-5"></div>
    <div class="bg-shaka-light">
        <img src="{{asset('images/homepage3.png')}}" class="w-100 d-block d-md-none" alt=""
             style="max-height: 730px; object-fit: cover">
        <div class="container mt-5" style="position:relative;">
            <div class="row ">
                <div class="align-items-center col-md-6 col-sm-12 d-flex flex-column justify-content-center order-md-0 order-1">
                    <h2 class="text-left w-100 mb-3 text-shaka-black">About the label</h2>
                    <p class="mt-3 text-shaka-subtitle" style="padding-right: 7rem;">
                        Shaka is based on sustainable design, which strengthens and encourages awareness raising, fair
                        production, animal welfare, environmental protection and careful use of our resources.
                    </p>
                    <div class="mt-5 w-100">
                        <a href="{{ route("shop.about") }}" class="btn px-4 py-3 rounded-0 bg-shaka-primary">Read more</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 opacity-0 order-0 order-md-1 d-none d-md-block">
                    <img src="{{asset('images/homepage3.png')}}" class="w-100" alt=""
                         style="max-height: 730px; object-fit: cover">
                </div>
            </div>
            <img src="{{asset('images/homepage3.png')}}" class="d-none d-md-block" alt="" style="max-height: 730px;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 50%;
    height: 100%;
    aspect-ratio: 1/1;
    width: 50vw;
    object-position: left;">
        </div>
        <div class="d-block d-md-none pt-5"></div>
    </div>

    <img src="{{asset('images/homepage4.png')}}" class="w-100 d-block d-md-none" alt=""
         style="max-height: 730px; object-fit: cover">
    <div class="">
        <div class="container " style="position:relative;">
            <div class="row ">
                <div class="col-sm-12 col-md-6 opacity-0 d-none d-md-block">
                    <img src="{{asset('images/homepage4.png')}}" class="w-100" alt=""
                         style="max-height: 730px; object-fit: cover">
                </div>
                <div class="align-items-center col-md-6 col-sm-12 d-flex flex-column justify-content-center py-5 pl-5" style="padding-top: 6rem!important; padding-bottom: 6rem!important">
                    <h2 class="text-left w-100 mb-1 text-shaka-black">Newsletter Subscription</h2>
                    <p class="mt-1 text-shaka-subtitle text-left w-100" style="padding-right: 7rem;">
                        Subscribe to our newsletter and stay updated for new Shaka arrivals.
                    </p>
                    <div class="mt-3 w-100 subscribe d-flex">
                        <input type="text" class="w-100" placeholder="Your email address"><button href="#" class="bg-shaka-primary">Subscribe</button>
                    </div>
                </div>

            </div>
            <img src="{{asset('images/homepage4.png')}}" class="d-none d-md-block" alt="" style="max-height: 730px;
    object-fit: cover;
    position: absolute;
    top: 0;
    right: 50%;
    height: 100%;
    aspect-ratio: 1/1;
    width: 50vw;
    object-position: left;">
        </div>
    </div>
@endsection

