@extends('shop::layouts.master')

@section('page_title')
    Shaka | About the label
@endsection

@section('content-wrapper')

    <div class="about-content text-white">


        <!-- The slideshow -->
        <div class="about-container" style="background-image: url({{ asset('images/404img.png') }});">
            <div class="container">
                <h1 class="text-uppercase text-center font-shaka" style="letter-spacing: 3px; font-size: 180px">404</h1>
                <p class="text-center fs18">Oops! The page you are looking for does not exist.</p>
                <p class="mt-5 text-center">
                    <a href="/" class="theme-btn px-5 py-3 fs20 text-center mx-auto">Go to homepage</a>
                </p>
            </div>

        </div>

    </div>





@endsection
