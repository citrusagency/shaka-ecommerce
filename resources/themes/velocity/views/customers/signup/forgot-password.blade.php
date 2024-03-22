@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.forgot-password.page_title') }}
@endsection

@section('content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1">
                <div class="mt-5 heading text-center">
                    <h1 class="fs30 fw2">
                        Forgot your password?
                    </h1>
                    <p class="fs16  shaka-p text-center" >
                        No worries, we'll send you a recovery link
                    </p>
                </div>

                <div class="container border-0 px-0 pt-0">

                    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                    <form
                        method="post"
                        action="{{ route('customer.forgot-password.store') }}"
                        @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                        <div class="control-group my-4" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email">
                                E-mail address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-style login-input"
                                placeholder="Email"
                                v-validate="'required|email'"/>

                            <p class="control-error mt-3" v-if="errors.has('email')"
                               v-text="errors.first('email')"></p>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.after') !!}

                        <button class="theme-btn bg-shaka-primary w-100" type="submit">
                            Get a recovery link
                        </button>
                        <div class="text-center mb-5 pt-2">
                            <a href="{{ route('customer.session.index') }}">
                                Sign in
                            </a>
                        </div>

                    </form>

                    {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}
                </div>
            </div>
        </div>
    </div>
@endsection