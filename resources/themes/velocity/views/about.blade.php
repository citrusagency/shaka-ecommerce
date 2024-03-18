@extends('shop::layouts.master')

@section('page_title')
    About the label
@endsection

@section('content-wrapper')

    <div class="about-content text-white">


        <!-- The slideshow -->
        <div class="about-container" style="background-image: url({{ asset('images/about.png') }});">
            <div class="container">
                <h1 class="text-uppercase text-center font-shaka" style="letter-spacing: 3px">About the label</h1>
            </div>

        </div>

    </div>

    <div class="bg-shaka-light">
        <div class="container py-5 py-md-0">
            <div class="row p-shaka-about">
                <div class="col-12 col-md-6 px-0 px-md-5">
                    <h2 class="font-shaka px-0 px-md-5">
                        We are all born creative and use our innovation and flair
                        to negotiate life.
                    </h2>
                </div>
                <div class="col-12 col-md-6 p-0">
                    <p class="text-shaka-subtitle m-0 px-0 px-md-5 mt-4 mt-md-0">
                        Life is energy,
                        everything is energy. The energy of her design pieces attract new experiences, transformations,
                        freedom, knowledge, which when you wear you feel beautiful and loved, feel the energy of
                        freedom and know that you are unique and stunning.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="d-block" style="position: relative">

        <img src="{{asset('images/about2.png')}}" class="d-none d-md-block" alt="" style="max-height: 730px;
    object-fit: cover;
    position: absolute;
    top: 0;
    right: 50%;
    height: 100%;
    aspect-ratio: 1/1;
    width: 50vw;
    object-position: left;">
        <img src="{{asset('images/about2.png')}}" alt="" class="d-block d-md-none w-100">
        <div class="container">


            <div class="row ">
                <div class="col-sm-12 col-md-6">
                    {{--                <img src="{{asset('images/about1.png')}}" class="w-100 d-block d-md-none" alt="">--}}
                </div>
                <div
                    class="align-items-center p-shaka-about col-md-6 col-sm-12 d-flex flex-column justify-content-center p-5">
                    <h2 class="text-left w-100 mb-3 font-shaka">About the artist</h2>
                    <p style="font-size: 16px">
                        Katarina Zlajic lives and works in Montenegro.
                        Throughout her career in sculpture she developed a great interest in jewelry design and its
                        craftsmanship. Evolving from this passion her first jewelery collection was created in 2015 but
                        SHAKA LABEL was founded in 2020.
                        <br>
                        <br>

                        Katarina likes to explore some new, unfamiliar segments and so she discovers and learns. She
                        adores these processes because they bring invaluable personal experiences.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-block" style="position: relative">

        <img src="{{asset('images/collection1.png')}}" class="d-none d-md-block" alt="" style="max-height: 730px;
    object-fit: cover;
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    aspect-ratio: 1/1;
    transform: scaleX(1);
    width: 50vw;
    object-position: left;">
        <img src="{{asset('images/collection1.png')}}" alt="" class="d-block d-md-none w-100">
        <div class="container">


            <div class="row ">

                <div
                    class="align-items-center p-shaka-about-2 col-md-6 col-sm-12 d-flex flex-column justify-content-center p-5" style="padding-top:8em !important;">
                    <p style="font-size: 16px">
                        The great driver of her creative process is the nature and the material she chooses to make the
                        pieces. She gives special importance to colors and shapes for the final look of subtlety and
                        sophistication.
                        <br><br>
                        Hand contact during creation is irreplaceable and invaluable, so all collections are
                        made by hand, with a focus on all the necessary precision and details throughout the process of
                        making.
                        <br><br>
                        She simply listens to her inner feelings and always follows them. For her, the creative
                        processes are pure meditation.
                    </p>
                </div>
{{--                <div class="col-sm-12 col-md-6">--}}
{{--                    --}}{{--                <img src="{{asset('images/about1.png')}}" class="w-100 d-block d-md-none" alt="">--}}
{{--                </div>--}}
            </div>
        </div>
    </div>


    {{--<div class="bg-shaka-light d-none d-md-block">--}}
    {{--    <div class="container">--}}
    {{--        <div class="row p-shaka-about">--}}
    {{--            <div class="col-12 col-md-6 px-5">--}}
    {{--                <h2 class="font-shaka px-4">--}}
    {{--                    We are all born creative and use our innovation and flair--}}
    {{--                    to negotiate life.--}}
    {{--                </h2>--}}
    {{--            </div>--}}
    {{--            <div class="col-12 col-md-6">--}}
    {{--                <p class="text-shaka-subtitle px-5">--}}
    {{--                    Life is energy,--}}
    {{--                    everything is energy. The energy of her design pieces attract new experiences, transformations,--}}
    {{--                    freedom, knowledge, which when you wear you feel beautiful and loved, feel the energy of--}}
    {{--                    freedom and know that you are unique and stunning.--}}
    {{--                </p>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}

@endsection
