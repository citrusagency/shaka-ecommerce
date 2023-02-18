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
                        Returns
                    </h3>
                </div>
            </div>

        </div>
    </div>
    <div class="container pt-5">
        <div class="row mt-5">
            <div class="col-12">
                {!! $r->html_content !!}
            </div>
        </div>

    </div>

@endsection



