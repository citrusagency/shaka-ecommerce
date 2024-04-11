@extends('shop::layouts.master')

@section('page_title')
    {{ __('contact_lang::app.shop.title') }}
@endsection

@section('content-wrapper')
    @push('css')
        <style>
            button {
                padding: 8px 22px;
                align-items: center;
                border-radius: 8px !important;
                background: #1197C2;
                color: #FFF;
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 22px;
                letter-spacing: 0.48px;
            }

            input, textarea {
                border: transparent 0px !important;
                border-radius: 8px !important;
            }

            label {
                color: #777777;
            }

            .shaka-p {
                font-family: "Outfit", sans-serif;
                font-size: 18px;
                font-style: normal;
                color: #777;
                font-weight: 300;
                line-height: 32px;
            }

            input[type='checkbox'].shaka-checkbox {
                width: 20px;
                height: 20px;
                outline: transparent;
                border-radius: 100px;
                accent-color: #1197c2;
            }



        </style>
    @endpush
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async></script>

        <script async>
            function onSubmit(token) {
                document.getElementById("contactForm").submit();
            }
        </script>
    @endpush

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
                                <div class="body col-12 w-100">
                                    <h1 class="fw2 mb-3">Contact</h1>
                                    <p class="mt-2 mb-5 shaka-p">If you need any help or have collaboration on mind,
                                        please reach out via contact form.</p>
                                    <form class="cd-form floating-labels w-100 "
                                          action="{{ route('shop.contact.send-message') }}" method="post"
                                          id="contactForm">
                                        {{ csrf_field() }}
                                        @error('g-recaptcha-response')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="cd-label mb-2" for="cd-name">Name</label>
                                                    <input class="text-input form-style py-4"
                                                           placeholder="Name..." type="text" name="name"
                                                           id="cd-name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="cd-label mb-2"
                                                           for="cd-email">E-mail address</label>
                                                    <input class="text-input form-style py-4"
                                                           placeholder="Email..." type="email" name="email"
                                                           id="cd-email" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label class="cd-label mb-2"
                                                   for="cd-message_title">Subject</label>
                                            <input class="text-input form-style py-4"
                                                   placeholder="Subject..." type="text" name="message_title"
                                                   id="cd-message_title" required>
                                        </div>

                                        <div class="form-group mt-5">
                                            <label class="cd-label mb-2" for="cd-textarea">Your
                                                message</label>
                                            <textarea class="message form-control"
                                                      placeholder="Message..." name="message_body" rows="10"
                                                      id="cd-textarea" required></textarea>
                                        </div>

                                        <div class="form-group captcha g-recaptcha "
                                             data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                        </div>

                                        <div class="form-group contact-checkbox">
                                            <input type="checkbox" name="" class=" contact-checkbox" id=""
                                                   required> <span class="shaka-p">By checking this box, I agree to the <a
                                                    href="/privacy-policy" target="_blank">Privacy Policy</a> </span>
                                        </div>

                                        <button
                                            class="theme-btn btn-shaka bg-shaka-primary fw1 btn mt-4"
                                            type="submit"
                                            data-action='submit'>Send a message
                                        </button>
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