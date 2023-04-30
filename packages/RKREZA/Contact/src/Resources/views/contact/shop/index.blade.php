@extends('shop::layouts.master')

@section('page_title')
    {{ __('contact_lang::app.shop.title') }}
@endsection

@section('content-wrapper')

    <style>
        input {
            border: 1px solid #a9a9;
        }
    </style>
    <div class="d-block mt-0 bg-shaka-light" style="position: relative">

        <img src="{{asset('images/contact.png')}}" class="d-none d-md-block" alt="" style="
        object-fit: cover;
        position: absolute;
        top: 0;
        right: 50%;
        height: 100%;
        width: 50vw;
        object-position: left;">
        <img src="{{asset('images/contact.png')}}" alt="" class="d-block d-md-none w-100">
        <div class="container">
            <div class="row py-5">
                <div class="col-sm-12 col-md-6">
                </div>
                <div class="align-items-center col-md-6 col-sm-12 d-flex flex-column justify-content-center py-5">
                    <div class="auth-content w-100">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 pl-md-5">
                                {{-- <div class="heading">
                                    <h2 class="fs24 fw6">
                                        {{ __('contact_lang::app.shop.title') }}
                                    </h2>
                                </div> --}}

                                <div class="body col-12 w-100">
                                    <h1 class="fw2 font-shaka mb-5">
                                        Contact us
                                    </h1>


                                    <form class="cd-form floating-labels w-100 "
                                          action="{{ route('shop.contact.send-message') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="cd-label " for="cd-name">Name*</label>
                                                    <input class="text-input form-style" type="text" name="name"
                                                           id="cd-name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="cd-label" for="cd-email">Email*</label>
                                                    <input class="text-input  form-style" type="email" name="email"
                                                           id="cd-email" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label class="cd-label " for="cd-message_title">Subject*</label>
                                            <input class="text-input form-style" type="text" name="message_title"
                                                   id="cd-message_title" required>
                                        </div>

                                        {{-- <div class="form-group">
                                           <label class="cd-label" for="cd-mobile">Phone Number</label>
                                           <input class="text-input  form-style" type="number" name="phone" id="cd-mobile" required>
                                        </div>  --}}

                                        <div class="form-group mt-5">
                                            <label class="cd-label" for="cd-textarea">Your message*</label>
                                            <textarea class="message  form-control" name="message_body" rows="10"
                                                      id="cd-textarea" required></textarea>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                    class="theme-btn bg-shaka-primary fw1 btn-block p-3 mt-4"
                                                    style="width: auto;">Send a message
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection