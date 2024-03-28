@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-head mb-15">
        <span class="account-heading">{{ __('shop::app.customer.account.profile.index.title') }}</span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

    <form
        class="center_div profile-form"
        method="POST"
        @submit.prevent="onSubmit"
        action="{{ route('customer.profile.store') }}"
        enctype="multipart/form-data">

        <div class="account-table-content">
            @csrf

            {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}
            <div class="row d-flex justify-content-between">

                <div :class="`col-lg-6 col-md-10 col-sm-12 form-group ${errors.has('first_name') ? 'has-error' : ''}`">
                    <label class="mandatory form-label">
                        {{ __('shop::app.customer.account.profile.fname') }}
                    </label>


                    <input value="{{ $customer->first_name }}" class="profile-input form-control" name="first_name"
                           type="text" v-validate="'required'"
                           data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;"/>
                    <span class="control-error" v-if="errors.has('first_name')"
                          v-text="errors.first('first_name')"></span>

                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after', ['customer' => $customer]) !!}

                <div :class="`col-lg-6 col-md-10 col-sm-12 form-group ${errors.has('last_name') ? 'has-error' : ''}`">
                    <label class="mandatory form-label">
                        {{ __('shop::app.customer.account.profile.lname') }}
                    </label>

                    <input value="{{ $customer->last_name }}" class="profile-input form-control" name="last_name"
                           type="text" v-validate="'required'"
                           data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;"/>
                    <span class="control-error" v-if="errors.has('last_name')"
                          v-text="errors.first('last_name')"></span>

                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.edit.last_name.after', ['customer' => $customer]) !!}
            </div>


            <div class="row">

                <div class="col-lg-6 col-md-10 col-sm-12">
                    <label class="mandatory">
                        {{ __('shop::app.customer.account.profile.email') }}
                    </label>

                    <input class="profile-input form-control" value="{{ $customer->email }}" name="email" type="text"
                           v-validate="'required'"/>
                    <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.email.after', ['customer' => $customer]) !!}

                <div class="col-lg-6 col-md-10 col-sm-12">
                    <label class="">
                        {{ __('shop::app.customer.account.profile.phone') }}
                    </label>

                    <input class="profile-input form-control"
                           value="{{ old('phone') ?? $customer->phone }}" name="phone" type="text"/>
                    <span class="control-error" v-if="errors.has('phone')" v-text="errors.first('phone')"></span>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.phone.after', ['customer' => $customer]) !!}
            </div>

            <div class="p-3 card border-dark bg-light col-lg-6 col-md-10 col-sm-12">
                <h4 class="card-title">Change your password</h4>
                <div class="row card-body">
                    <label class="col-12">
                        {{ __('velocity::app.shop.general.enter-current-password') }}
                    </label>

                    <div :class="` col-12 ${errors.has('oldpassword') ? 'has-error' : ''}`">
                        <input class="profile-input form-control" value="" name="oldpassword" type="password"/>
                    </div>

                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after', ['customer' => $customer]) !!}

                <div class="row card-body">
                    <label class="col-12">
                        {{ __('velocity::app.shop.general.new-password') }}
                    </label>

                    <div :class="` col-12 ${errors.has('password') ? 'has-error' : ''}`">
                        <input
                            class="profile-input form-control"
                            value=""
                            name="password"
                            ref="password"
                            type="password"
                            v-validate="'min:6'"/>

                        <span class="control-error" v-if="errors.has('password')"
                              v-text="errors.first('password')"></span>
                    </div>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.password.after', ['customer' => $customer]) !!}

                <div class="row card-body">
                    <label class="col-12">
                        {{ __('velocity::app.shop.general.confirm-new-password') }}
                    </label>

                    <div
                        :class="`col-12 ${errors.has('password_confirmation') ? 'has-error' : ''}`">
                        <input class="profile-input form-control" value="" name="password_confirmation" type="password"
                               v-validate="'min:6|confirmed:password'" data-vv-as="confirm password"/>

                        <span class="control-error" v-if="errors.has('password_confirmation')"
                              v-text="errors.first('password_confirmation')"></span>
                    </div>
                </div>

                @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                    <div class="control-group">
                        <input type="checkbox" id="checkbox2" name="subscribed_to_news_letter"
                               @if (isset($customer->subscription)) value="{{ $customer->subscription->is_subscribed }}"
                               {{ $customer->subscription->is_subscribed ? 'checked' : ''}} @endif  style="width: auto;">
                        <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                    </div>
                @endif

                {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}

            </div>
            <button
                type="submit"
                class="theme-btn w-100 mt-3 mb20">
                Save
            </button>
        </div>
    </form>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}
@endsection
