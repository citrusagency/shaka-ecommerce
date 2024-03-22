@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="auth-content form-container">

        {!! view_render_event('bagisto.shop.customers.login.before') !!}

            <div class="container">
                <div class="col-lg-10 col-md-12 offset-lg-1 py-3 justify-content-center">
                    <div class="heading text-center">
                        <h1 class="fs30 fw2 font-shaka">
                            Sign in
                        </h1>
                    </div>

                    <div class="container border-0 p-0">

                        <form
                            method="POST"
                            action="{{ route('customer.session.create') }}"
                            @submit.prevent="onSubmit">

                            {{ csrf_field() }}

                            {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                            <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email">
                                    {{ __('shop::app.customer.login-form.email') }}
                                </label>

                                <input
                                    type="text"
                                    class="form-style login-input"
                                    name="email"
                                    v-validate="'required|email'"
                                    value="{{ old('email') }}"
                                    placeholder="Email"
                                    data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;" />

                                <p class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></p>
                            </div>

                            <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">
                                    {{ __('shop::app.customer.login-form.password') }}
                                </label>

                                <input
                                    type="password"
                                    class="form-style login-input"
                                    name="password"
                                    id="password"
                                    v-validate="'required'"
                                    value="{{ old('password') }}"
                                    placeholder="Password"
                                    data-vv-as="&quot;{{ __('shop::app.customer.login-form.password') }}&quot;" />
                                <p class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></p>
                                <input type="checkbox" onclick="myFunction()" id="showPassword" class="show-password shaka-checkbox"> {{ __('shop::app.customer.login-form.show-password') }}

                                <a href="{{ route('customer.forgot-password.create') }}" class=" show-password float-right">
                                    {{ __('shop::app.customer.login-form.forgot_pass') }}
                                </a>

                                <div>
                                    @if (Cookie::has('enable-resend'))
                                        @if (Cookie::get('enable-resend') == true)
                                            <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                            <button class="theme-btn bg-shaka-primary w-100"  type="submit"> {{ __('shop::app.customer.login-form.button_title') }} </button>
                            <p class="text-center mt-3">
                                Don't have an account? <a href="{{ route('customer.register.index') }}" class="btn-new-customer">
                                    {{ __('velocity::app.customer.login-form.sign-up')}}
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>

        {!! view_render_event('bagisto.shop.customers.login.after') !!}
    </div>
@endsection

@push('scripts')
<script>
    $(function(){
        $(":input[name=email]").focus();
    });

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

@endpush



