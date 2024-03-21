@extends('shop::layouts.master')

@section('page_title')
    Shaka | Password Reset
@endsection

@section('content-wrapper')

    <div class="about-content">
        <div class="about-container" style="background-color: #EEEEE9;">
            <div class="container">
                <h1 class="text-uppercase text-center">Your password is updated.</h1>
                <p class="mt-5 text-center">
                    <a href="{{ route('customer.session.index') }}">
                        Back to Sign in
                    </a>
                </p>
            </div>

        </div>

    </div>





@endsection
