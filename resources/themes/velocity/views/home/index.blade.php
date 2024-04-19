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

@section('full-content-wrapper')

    <div class="homepage-img text-white">
        <div id="demo" class="carousel slide" data-ride="carousel" style="margin-top: -20vh;">

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
                            <h1 class="homepage-heading text-uppercase mb-5 heading-mbl">Shop extravagant <br>jewelry</h1>
                            <button class="btn-shaka bg-shaka-primary bnt-shaka-primary">Shop now</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev"></a>
            <a class="carousel-control-next" href="#demo" data-slide="next"></a>
        </div>
    </div>

    <div class="full-content-wrapper container">
        <!-- {!! view_render_event('bagisto.shop.home.content.before') !!} -->
        <!-- @include('shop::home.advertisements.advertisement-four') -->
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
                    <h2 class="text-left w-100 mb-3 text-shaka-black text-uppercase fs32 f-normal">About the label</h2>
                    <p class="mt-3 text-shaka-subtitle fs18 f-normal fw3 line-h32" style="padding-right:50px !important;">
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
                    <h2 class="text-left w-100 mb-1 text-shaka-black text-uppercase fs32 f-normal">Newsletter Subscription</h2>
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
                            <form id="registrationForm" action="{{ route('shop.subscribe') }}" class="d-flex w-100" method="POST">
                                @csrf
                                <input type="hidden" name="token" id="token" value="{{ $token ?? null }}">
                                <input type="email" name="subscriber_email" id="subscriber_email" class="w-100 input-stl" placeholder="Your email address" value="{{ $customerEmail ?? '' }}"{{ auth()->check() ? ' readonly' : '' }} style="border-bottom-right-radius: 0 !important; border-top-right-radius: 0 !important;">
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

