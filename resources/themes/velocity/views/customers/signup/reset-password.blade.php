@extends('shop::layouts.master')

@section('page_title')
 {{ __('shop::app.customer.reset-password.title') }}
@endsection

@section('content-wrapper')

<div class="auth-content py-5">
    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
        <div class="auth-content form-container">
            <div class="container">
                <div class="col-lg-10 col-md-12 offset-lg-1 text-center">
                    <div class="heading">
                        <h2 class="fs30 fw2">
                            {{ __('shop::app.customer.reset-password.title')}}
                        </h2>
                    </div>

                    <div class="text-left body col-12 p-0 border-0">

                        {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                        <form
                            method="POST"
                            @submit.prevent="onSubmit"
                            action="{{ route('customer.reset-password.store') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                            <div :class="`form-group ${errors.has('email') ? 'has-error' : ''}`">
                                <label for="email" class="">
                                    {{ __('shop::app.customer.reset-password.email') }}
                                </label>

                                <input
                                    id="email"
                                    type="text"
                                    name="email"
                                    placeholder="Email"
                                    class="form-style login-input"
                                    value="{{ old('email') }}"
                                    v-validate="'required|email'" />
                                <p class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></p>
                            </div>

                            <div :class="`form-group ${errors.has('password') ? 'has-error' : ''}`">
                                <label for="password" class="">
                                    New password
                                </label>

                                <input
                                    ref="password"
                                    placeholder="New Password"
                                    class="form-style login-input password"
                                    name="password"
                                    type="password"
                                    v-validate="'required|min:6'" />

                                <p class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></p>
                            </div>

                            <div :class="`form-group ${errors.has('confirm_password') ? 'has-error' : ''}`">
                                <label for="confirm_password" class="">
                                    Confirm password
                                </label>

                                <input
                                    type="password"
                                    placeholder="New Password"
                                    class="form-style login-input password"
                                    name="password_confirmation"
                                    v-validate="'required|min:6|confirmed:password'" />

                                <p class="control-error" v-if="errors.has('password_confirmation')" v-text="errors.first('password_confirmation')"></p>
                            </div>

                            <div class="control-group">
                                <input type="checkbox" onclick="showPassword()">Show Password
                            </div>

                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.after') !!}

                            <button class="theme-btn bg-shaka-primary" type="submit">
                                {{ __('shop::app.customer.reset-password.submit-btn-title') }}
                            </button>
                        </form>


                        {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}
                    </div>
                </div>
            </div>
        </div>
    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $(":input[name=email]").focus();
        });

        function showPassword() {
            let passwords = document.querySelectorAll('.password');
            const passwordArray = Array.from(passwords);
            passwordArray.forEach(function (element) {
                if (element.type === "password") {
                    element.type = "text";
                } else {
                    element.type = "password";
                }
            });
        }
    </script>

@endpush