
@extends('shop::layouts.master')

@section('page_title')
    Shaka | Behind the scenes
@endsection

@section('content-wrapper')

    <div class="bg-shaka-light">
        <div class="container py-2 py-md-0">
            <div class="row py-4">
                <div class="col-12">
                    <h3 class="text-shaka-black text-center m-0 px-0 px-md-5 mt-4 mt-md-0 font-shaka">
                        Behind the scenes
                    </h3>
                </div>
            </div>

        </div>
    </div>
    <div class="container pt-5">
        <div class="row mt-5">
            <div class="col-sm-12 col-md-6 col-lg-4 pl-md-5">
                <h2 class="font-shaka pl-md-5">Pictures from our workshop</h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-8 pr-md-5">
                <p class="fs16 text-shaka-subtitle pr-md-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Condimentum dui sem augue ultrices
                    mauris. Ut tristique nam erat ut mi velit pellentesque ullamcorper pulvinar. Pharetra, sit id
                    enim sed pharetra. Nunc convallis sed blandit netus senectus feugiat.</p>
            </div>

            <div class="col-12 mt-5">
                <img src="{{asset('images/bts1.png')}}" class="w-100" alt="">
                <span class="text-shaka-subtitle">Image caption</span>
            </div>
            <div class="col-md-6 offset-md-3 mt-5">
                <p class="text-shaka-subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Condimentum dui sem augue ultrices
                    mauris. Ut tristique nam erat ut mi velit pellentesque ullamcorper pulvinar. Pharetra, sit id
                    enim sed pharetra. Nunc convallis sed blandit netus senectus feugiat.
                </p>
            </div>
        </div>

        <div class="row mt-5 pb-5">
            <div class="col-md-6 col-sm-12">
                <img src="{{ asset('images/bts2.png') }}" class="w-100 mt-4" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
                <img src="{{ asset('images/bts3.png') }}" class="w-100 mt-4" alt="">
            </div>
            <div class="col-12">
                <img src="{{ asset('images/bts4.png') }}" class="w-100 mt-4" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
                <img src="{{ asset('images/bts5.png') }}" class="w-100 mt-4" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
                <img src="{{ asset('images/bts6.png') }}" class="w-100 mt-4" alt="">
            </div>
            <div class="col-12 mb-5">
                <img src="{{ asset('images/bts7.png') }}" class="w-100 mt-4" alt="">
            </div>
        </div>
    </div>


@endsection



