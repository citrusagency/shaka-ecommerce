<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- title --}}
    <title>@yield('page_title')</title>

    {{-- meta data --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style>

        p{
            font-size: 18px!important;
            line-height: 32px!important;
            font-family: "Outfit", sans-serif!important;
        }
         input[type='checkbox'].shaka-checkbox {
             width: 20px;
             height: 20px;
             outline: transparent;
             border-radius: 100px;
             accent-color: #1197c2;
         }

        .material-icons{
            font-family: 'Material Icons'!important;
        }

        .text-shaka-primary {
            color: #1197C2!important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Open Sans', serif;
            letter-spacing: 2px;
            font-size: 3rem;
            text-transform: uppercase;
        }

        .bnt-shaka-primary{
            color:#1197C2 !important;
            border-radius: 8px !important;
            font-size: 16px !important;
            font-family: 'Outfit', sans-serif !important;
            font-weight: 600 !important;
            line-height: 22px !important;
            padding: 8px 22px !important;
        }


        .bnt-shaka-primary:hover{
            color:#0A7A9D;
        }

        .outline-btn{
            color:#0A7A9D !important;
            background-color: #fff !important;
            border: 2px solid #0A7A9D !important;
        }

        .outline-btn:hover{
            background-color: rgba(183, 183, 183, 0.33) !important;
            text-decoration: none;
        }

        /* ------------ FOOTER STYLES ------------ */
        .footer-con{
            padding:50px 260px !important;
        }
        .footer-flex{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .footer-col{
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: left;
        }
        .made-by{
            color: #a1a1a1 !important;
            text-align: right;
            font-weight: 300;
            line-height: normal;
        }
        .citrus-codes{
            color: #1197C2 !important;
            font-weight: 600;
            line-height: 22px;
            letter-spacing: 0.48px;
        }
        .footer-text{
            font-size: 16px;
            font-style: normal;
            font-family: Outfit, sans-serif;
        }
        .footer-links{
            color: #FFF;
            font-weight: 300;
            line-height: normal;
        }

        @media only screen and (max-width: 500px){
            .footer-text{
                font-size: 14px;
                font-weight: 400 !important;
            }
            .footer-con{
                padding:40px 16px 24px 16px !important;
            }
            .footer-flex{
                display: flex;
                flex-direction: column;
            }
            .footer-col{
                justify-content: center;
                align-items: center;
            }
        }
    </style>


    {!! view_render_event('bagisto.shop.layout.head') !!}

    {{-- for extra head data --}}
    @yield('head')

    {{-- seo meta data --}}
    @yield('seo')

    {{-- fav icon --}}
    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}"/>
    @else
        <link rel="icon" sizes="16x16" href="{{ asset('/themes/velocity/assets/images/static/v-icon.png') }}"/>
    @endif

    {{-- all styles --}}
    @include('shop::layouts.styles')
</head>
<body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction === 'rtl') class="rtl" @endif class="{{ str_contains(request()->getUri(), 'customer') ? 'bg-shaka-light' : '' }}">
{!! view_render_event('bagisto.shop.layout.body.before') !!}

{{-- main app --}}
<div id="app">
    <product-quick-view v-if="$root.quickView"></product-quick-view>

    <div class="main-container-wrapper">

        @section('body-header')
            {{-- top nav which contains currency, locale and login header --}}
            <!-- @include('shop::layouts.top-nav.index') -->

            {!! view_render_event('bagisto.shop.layout.header.before') !!}

            {{-- primary header after top nav --}}
            @include('shop::layouts.header.index')

            {!! view_render_event('bagisto.shop.layout.header.after') !!}

            <div class="main-content-a col-12 no-padding">

                {{-- secondary header --}}
                <header class="row velocity-divide-page bg-shaka-black2 text-white vc-header header-shadow active">

                    {{-- mobile header --}}
                    <div class="vc-small-screen container">
                        @include('shop::layouts.header.mobile')
                    </div>

                    {{-- desktop header --}}
                    {{--                            @include('shop::layouts.header.desktop')--}}

                </header>

                <div class="">
                    <div class="row col-12 remove-padding-margin">
                        <sidebar-component
                            main-sidebar=true
                            id="sidebar-level-0"
                            url="{{ url()->to('/') }}"
                            category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
                            add-class="category-list-container pt10">
                        </sidebar-component>
                    </div>
                </div>
            </div>
        @show

{{--            <div class="col-12 no-padding content" id="home-right-bar-container">----}}
{{--                <div class="container-right row no-margin col-12 no-padding">----}}
{{--                    {!! view_render_event('bagisto.shop.layout.content.before') !!}--}}

{{--                    @yield('content-wrapper')--}}

{{--                    {!! view_render_event('bagisto.shop.layout.content.after') !!}--}}
{{--                </div>--}}

{{--            </div>--}}

        <div class="">
{{--            {!! view_render_event('bagisto.shop.layout.full-content.before') !!}--}}

            @yield('full-content-wrapper')

            {{--                    {!! view_render_event('bagisto.shop.layout.content.before') !!}--}}

            {{--                    @yield('content-wrapper')--}}

            {{--                    {!! view_render_event('bagisto.shop.layout.content.after') !!}--}}
            @yield('content-wrapper')

            {!! view_render_event('bagisto.shop.layout.full-content.after') !!}
        </div>
    </div>

    {{-- overlay loader --}}
    <velocity-overlay-loader></velocity-overlay-loader>

{{--    <go-top bg-color="#26A37C"></go-top>--}}
</div>

{{-- footer --}}
@section('footer')
    {!! view_render_event('bagisto.shop.layout.footer.before') !!}

    @include('shop::layouts.footer.index')

    {!! view_render_event('bagisto.shop.layout.footer.after') !!}
@show

{!! view_render_event('bagisto.shop.layout.body.after') !!}

{{-- alert container --}}
<div id="alert-container"></div>

{{-- all scripts --}}
@include('shop::layouts.scripts')
</body>
</html>
