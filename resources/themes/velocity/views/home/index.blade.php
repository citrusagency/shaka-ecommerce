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

        .homepage-img {
            margin-top: -130px;
            width: 100%;
            background-image: url({{ asset('images/homepage1.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding-top: 280px;
            padding-bottom: 180px;
        }
    </style>
@endpush

{{--@section('content-wrapper')--}}
{{--    @include('shop::home.slider')--}}
{{--@endsection--}}



@section('full-content-wrapper')

    <div class="homepage-img text-white">
        <div class="container">
            <h1 class="heading-1 font-weight-bold">Shaka & <br> Katarina Zlajić</h1>
            <p>Extravagant clothes and jewelry pieces.</p>
            <button class="btn bg-shaka-primary btn-lg px-5">Shop now</button>
        </div>
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

    <div class="full-content-wrapper container">
        <!-- {!! view_render_event('bagisto.shop.home.content.before') !!} -->


        <!-- @include('shop::home.advertisements.advertisement-four') -->
        @include('shop::home.featured-products')
        <!-- @include('shop::home.advertisements.advertisement-three') -->
        @include('shop::home.new-products')
        <!-- @include('shop::home.advertisements.advertisement-two') -->

        {{ view_render_event('bagisto.shop.home.content.after') }}
    </div>

@endsection

