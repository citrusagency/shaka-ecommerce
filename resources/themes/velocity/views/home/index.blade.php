@extends('shop::layouts.master')

@inject ('productRatingHelper', 'Webkul\Product\Helpers\Review')

@php
    $channel = core()->getCurrentChannel();

    $homeSEO = $channel->home_seo;

    $token=null;
    if(auth()->guard('customer')->user()){
        $customerEmail = auth()->guard('customer')->user()->email;
        $subscribed = auth()->guard('customer')->user()->subscribed_to_news_letter;
        $token = auth()->guard('customer')->user()->token;
    }

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    Home
{{--    {{ isset($metaTitle) ? $metaTitle : "" }}--}}
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
        .available:hover {
            text-decoration: underline;

        }
        .input-stl{
            border-radius: 8px 0 0 8px;
            border:1px solid #DADADA !important;
            color: #777;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 100%;
            letter-spacing: 0.28px;
            padding: 16px !important;
            height: 50px !important;
        }
        .btn-shaka{
            padding: 10px 16px;
            text-align: center;
            border: none;

            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 22px; /* 137.5% */
            letter-spacing: 0.48px;
        }
        .btn-stl{
            padding: 8px 22px;
            border-radius: 0 8px 8px 0 !important;
            background: #1197C2;
            letter-spacing: 0.48px;
            height: 50px !important;
        }
        .txt-stl{
            font-size: 18px;
            font-style: normal;
            font-weight: 300;
            line-height: 32px;
            padding-right: 0 !important;
        }

        .news-letter{
            padding-top: 11rem!important;
            padding-bottom: 11rem!important;
            padding-left:60px !important;
        }

        @media only screen and (max-width: 1220px) {
            .news-letter{
                padding:50px 15px !important;
            }
            .img-mobile{
                height: 500px;
            }
        }


        @media only screen and (max-width: 480px) {
            .news-letter{
                padding:50px 15px !important;
            }
            .img-mobile{
                height: 300px;
            }
            .heading-mbl{
                font-size: 32px !important;
            }
            .subtitle-mbl{
                font-size: 14px !important;
            }
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

    <script>
        $(".carousel").swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (direction === 'left') $(this).carousel('next');
                if (direction === 'right') $(this).carousel('prev');
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
        <div id="demo" class="carousel slide" data-ride="carousel" style="margin-top: -12vh;">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                @foreach($sliderData as $slider)
                    <li data-target="#demo" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner w-100">
                @foreach($sliderData as $slider)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url({{ $slider['image_url'] }});">
                        <div class="container">
                            <p class="text-uppercase subtitle-mbl" style="letter-spacing: 3px">Katarina Zlajić</p>
                            <h1 class="heading-1 text-uppercase font-weight-normal mb-5 heading-mbl">Shop extravagant <br>jewelry</h1>
                            <button class="btn-shaka bg-shaka-primary bnt-shaka-primary">Shop now</button>
                        </div>
                    </div>
                @endforeach


            </div>

            <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
{{--                            <span class="carousel-control-prev-icon"></span>--}}
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
{{--                            <span class="carousel-control-next-icon"></span>--}}
                        </a>
        </div>
{{--                @include('shop::home.slider')--}}
{{--                <div class="container">--}}
{{--                    <h1 class="heading-1 font-weight-bold">Shaka & <br> Katarina Zlajić</h1>--}}
{{--                    <p>Extravagant clothes and jewelry pieces.</p>--}}
{{--                    <button class="btn bg-shaka-primary btn-lg px-5">Shop now</button>--}}
{{--                </div>--}}
    </div>

{{--    <div class="bg-shaka-darker py-4">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-0">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">--}}
{{--                            <img src="{{ asset('images/vegan.svg') }}" class="" alt="">--}}
{{--                            <p class="text-white text-center mt-2">Vegan</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">--}}
{{--                            <img src="{{ asset('images/handmade.svg') }}" alt="">--}}
{{--                            <p class="text-white text-center mt-2">Handmade</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 d-flex justify-content-center align-items-center flex-column">--}}
{{--                            <img src="{{ asset('images/sustainable.svg') }}" alt="">--}}
{{--                            <p class="text-white text-center mt-2">Sustainable</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="bg-shaka-light py-5">--}}
{{--        <div class="container">--}}
{{--            <h2 class="text-center text-white text-shaka-black  heading-2 h1 mt-5 mb-2">--}}
{{--                Shop by collection--}}
{{--            </h2>--}}
{{--            <br>--}}
{{--            <div class="row mt-4 mb-5 py-3">--}}
{{--                <div class="col-md-6 col-sm-12 collection">--}}
{{--                    <a href="#">--}}
{{--                        <img src="{{ asset('images/collection1.png') }}" class="w-100 mt-3" alt="">--}}
{{--                        <div class="bg-shaka-light px-4 py-2 text-shaka-black text-uppercase collection-title titlovi"--}}
{{--                             style="letter-spacing: 2px">Katarina Zlajić--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-sm-12 collection">--}}
{{--                    <a href="#">--}}
{{--                        <img src="{{ asset('images/collection2.png') }}" class="w-100 mt-3" alt="">--}}
{{--                        <div class="bg-shaka-light px-4 py-2 text-shaka-black text-uppercase collection-title titlovi"--}}
{{--                             style="letter-spacing: 2px">Shaka--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
             style="max-height: 730px; object-fit: cover;">
        <div class="container mt-5" style="position:relative;">
            <div class="row ">
                <div class="align-items-center col-md-6 col-sm-12 d-flex flex-column justify-content-center order-md-0 order-1">
                    <h2 class="text-left w-100 mb-3 text-shaka-black  text-uppercase">About the label</h2>
                    <p class="mt-3 text-shaka-subtitle" style="font-size: 18px;
font-style: normal;
font-weight: 300;
line-height: 32px; padding-right:50px !important;">
                        Shaka is based on sustainable design, which strengthens and encourages awareness raising, fair
                        production, animal welfare, environmental protection and careful use of our resources.
                    </p>
                    <div class="mt-5 w-100">
                        <a href="{{ route("shop.about") }}" class="btn bg-shaka-primary bnt-shaka-primary" style="padding: 8px 22px !important; ">Read more</a>
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

    <div>
        <img src="{{asset('images/homepage4.png')}}" class="w-100 d-block d-md-none img-mobile" alt=""
             style="max-height: 730px; object-fit: cover;">
        <div class="container" style="position:relative;">
            <div class="row ">
                <div class="col-sm-12 col-md-6 opacity-0 d-none d-md-block">
                    <img src="{{asset('images/homepage4.png')}}" class="w-100" alt=""
                         style="max-height: 730px; object-fit: cover">
                </div>
                <div class="align-items-center col-md-6 col-sm-12 d-flex flex-column justify-content-center news-letter">
                    <h2 class="text-left w-100 mb-1 text-shaka-black text-uppercase">Newsletter Subscription</h2>
                    <p class="mt-1 text-shaka-subtitle text-left w-100 txt-stl" style="padding-right: 7rem;">
                        Subscribe to our newsletter and stay updated for new Shaka arrivals.
                    </p>
                        @if(isset($subscribed) && $subscribed)
                            <div class="mt-3 w-100 ">
                                <p class="mt-1 text-shaka-subtitle text-left w-100 txt-stl" style="padding-right: 7rem;">You are already subscribed to our newsletter. Do you want to unsubscribe?</p>
                                <a href="{{ route('shop.unsubscribe', $token) }}" class="btn bg-shaka-primary bnt-shaka-primary mt-3" style="padding: 8px 22px !important;">
                                    {!! __('shop::app.mail.customer.subscription.unsubscribe') !!}
                                </a>
                            </div>
                        @else
                            <div class="mt-3 w-100 subscribe d-flex">
                                <form id="registrationForm" action="{{ route('shop.subscribe') }}" class="d-flex w-100 p-2" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" id="token" value="{{ $token ?? null }}">
                                    <input type="text" name="subscriber_email" id="subscriber_email" class="w-100 input-stl" placeholder="Your email address" value="{{ $customerEmail ?? '' }}"{{ auth()->check() ? ' readonly' : '' }}>
                                    <button type="submit" id="submitButton" class="bg-shaka-primary btn-stl bnt-shaka-primary">Subscribe</button>
                                </form>
                            </div>
                        @endif
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

