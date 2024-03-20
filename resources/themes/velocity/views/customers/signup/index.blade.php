@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection

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
            color: #777;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0.7px

        }

        .shaka-p {
            font-family: "Outfit", sans-serif;
            font-size: 18px;
            font-style: normal;
            color: #777777;
            font-weight: 300;
            line-height: 32px;
        }

        .shaka-checkbox {
            width: 20px;
            height: 20px;
        }
    </style>
@endpush

@section('content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1 py-5">
                <div class="body col-12 border-0 p-0">
                    <h1 class="fw2 font-shaka text-center">
                        Create an account
                    </h1>

                    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

                    <form
                        method="post"
                        class="mt-4"
                        action="{{ route('customer.register.create') }}"
                        @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                        <div class="row">
                            <div class="control-group col-md-6 col-sm-12"
                                 :class="[errors.has('first_name') ? 'has-error' : '']">
                                <label for="first_name" class="required mb-3">
                                    {{ __('shop::app.customer.signup-form.firstname') }}
                                </label>

                                <input
                                    type="text"
                                    class="form-style px-3 py-4"
                                    name="first_name"
                                    v-validate="'required'"
                                    value="{{ old('first_name') }}"
                                    data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;"
                                />

                                <span class="control-error" v-if="errors.has('first_name')"
                                      v-text="errors.first('first_name')"></span>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

                            <div class="control-group col-md-6 col-sm-12"
                                 :class="[errors.has('last_name') ? 'has-error' : '']">
                                <label for="last_name" class="required mb-3">
                                    {{ __('shop::app.customer.signup-form.lastname') }}
                                </label>

                                <input
                                    type="text"
                                    class="form-style px-3 py-4"
                                    name="last_name"
                                    v-validate="'required'"
                                    value="{{ old('last_name') }}"
                                    data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;"/>

                                <span class="control-error" v-if="errors.has('last_name')"
                                      v-text="errors.first('last_name')"></span>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

                        </div>
                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="required mb-3">
                                {{ __('shop::app.customer.signup-form.email') }}
                            </label>

                            <input
                                type="email"
                                class="form-style px-3 py-4"
                                name="email"
                                v-validate="'required|email'"
                                value="{{ old('email') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;"/>

                            <span class="control-error" v-if="errors.has('email')"
                                  v-text="errors.first('email')"></span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}

                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="required mb-3">
                                {{ __('shop::app.customer.signup-form.password') }}
                            </label>
                            <input
                                id="password"
                                type="password"
                                class="form-style px-3 py-4 password"
                                name="password"
                                v-validate="'required|min:6'"
                                ref="password"
                                value="{{ old('password') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;"/>

                            <span class="control-error" v-if="errors.has('password')"
                                  v-text="errors.first('password')"></span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}

                        <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                            <label for="password_confirmation" class="required mb-3">
                                {{ __('shop::app.customer.signup-form.confirm_pass') }}
                            </label>

                            <input
                                type="password"
                                class="form-style px-3 py-4 password"
                                name="password_confirmation"
                                v-validate="'required|min:6|confirmed:password'"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;"/>

                            <span class="control-error" v-if="errors.has('password_confirmation')"
                                  v-text="errors.first('password_confirmation')"></span>
                        </div>

                        <div class="control-group">
                            <input type="checkbox" onclick="myFunction()">Show Password
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.password_confirmation.after') !!}

                        <div class="control-group">
                            {!! Captcha::render() !!}
                        </div>

                        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                            <div class="control-group">
                                <input type="checkbox" id="checkbox2" name="is_subscribed">
                                <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                            </div>
                        @endif

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                        <button class="theme-btn w-100 bg-shaka-primary" type="submit">
                            <b>
                                {{ __('shop::app.customer.signup-form.title') }}
                            </b>
                        </button>
                    </form>

                    <div>
                        <p class="shaka-p text-center">Already have an account?
                            <a href="{{ route('customer.session.index') }}" class="btn-new-customer">
                                {{ __('velocity::app.customer.signup-form.login')}}</a>
                        </p>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $(":input[name=first_name]").focus();
        });
    </script>

    <script>

        function myFunction() {
            let passwords = document.querySelectorAll('.password');
            const passwordArray = Array.from(passwords);

            console.log(passwords)
            console.log(passwordArray)
            passwordArray.forEach(function(element){
                if (element.type === "password") {
                    element.type = "text";
                } else {
                    element.type = "password";
                }
            });


        }
    </script>

    {!! Captcha::renderJS() !!}

@endpush