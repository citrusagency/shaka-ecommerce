@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="profile-content-title">
        {{ __('shop::app.customer.account.profile.index.title') }}
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

    <form
        class="profile-form"
        method="POST"
        @submit.prevent="onSubmit"
        action="{{ route('customer.profile.store') }}"
        enctype="multipart/form-data">

        <div class="account-table-content">
            @csrf
            {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}


            <div :class="`col-lg-6 col-md-10 col-sm-12 form-group ${errors.has('first_name') ? 'has-error' : ''}`">
                <label class="mandatory form-label">
                    {{ __('shop::app.customer.account.profile.fname') }}
                </label>


                <input value="{{ $customer->first_name }}" class="profile-control-input profile-input form-control" name="first_name"
                       type="text" v-validate="'required'" id="first_name"
                       data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;"/>
                <span class="control-error" v-if="errors.has('first_name')"
                      v-text="errors.first('first_name')"></span>

            </div>
            {!! view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after', ['customer' => $customer]) !!}

            <div :class="`col-lg-6 col-md-10 col-sm-12 form-group ${errors.has('last_name') ? 'has-error' : ''}`">
                <label class="mandatory form-label">
                    {{ __('shop::app.customer.account.profile.lname') }}
                </label>

                <input value="{{ $customer->last_name }}" class="profile-control-input profile-input form-control" name="last_name"
                       type="text" v-validate="'required'"
                       data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;"/>
                <span class="control-error" v-if="errors.has('last_name')"
                      v-text="errors.first('last_name')"></span>

            </div>
            {!! view_render_event('bagisto.shop.customers.account.profile.edit.last_name.after', ['customer' => $customer]) !!}


            <div class="col-lg-6 col-md-10 col-sm-12 form-group">
                <label class="mandatory form-label">
                    {{ __('shop::app.customer.account.profile.email') }}
                </label>

                <input class="profile-control-input profile-input form-control" value="{{ $customer->email }}" name="email" type="text"
                       v-validate="'required'"/>
                <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
            </div>
            {!! view_render_event('bagisto.shop.customers.account.profile.edit.email.after', ['customer' => $customer]) !!}

            <div class="col-lg-6 col-md-10 col-sm-12 form-group">
                <label class="form-label">
                    {{ __('shop::app.customer.account.profile.phone') }}
                </label>

                <input class="profile-control-input profile-input form-control"
                       value="{{ old('phone') ?? $customer->phone }}" name="phone" type="text"/>
                <span class="control-error" v-if="errors.has('phone')" v-text="errors.first('phone')"></span>
            </div>
            {!! view_render_event('bagisto.shop.customers.account.profile.edit.phone.after', ['customer' => $customer]) !!}


            <div class="mt-5 col-lg-6 col-md-10 col-sm-12 form-group">
                <h4 class="">Change your password</h4>
                <div class="">
                    <label class="form-label">
                        {{ __('velocity::app.shop.general.enter-current-password') }}
                    </label>

                    <div :class="`${errors.has('oldpassword') ? 'has-error' : ''}`">
                        <input class="profile-input form-control" value="" name="oldpassword" type="password"/>
                    </div>

                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after', ['customer' => $customer]) !!}

                <div class="">
                    <label class="form-label">
                        {{ __('velocity::app.shop.general.new-password') }}
                    </label>

                    <div :class="`${errors.has('password') ? 'has-error' : ''}`">
                        <input
                            class="profile-input form-control"
                            name="password"
                            ref="password"
                            type="password"
                            v-validate="'min:6'"/>

                        <span class="control-error" v-if="errors.has('password')"
                              v-text="errors.first('password')"></span>
                    </div>
                </div>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.password.after', ['customer' => $customer]) !!}

                <div class="">
                    <label class="form-label">
                        {{ __('velocity::app.shop.general.confirm-new-password') }}
                    </label>

                    <div
                        :class="` ${errors.has('password_confirmation') ? 'has-error' : ''}`">
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

                <div class="my-5">
                    <button
                        type="submit"
                        id="submitBtn"
                        class="display-block theme-btn col-lg-3 col-md-10 col-sm-12 mt-5 mb20" disabled>
                        Save
                    </button>

                    <button
                        type="submit"
                        class="display-block theme-btn col-lg-3 col-md-10 col-sm-12 mb-5" onclick="window.showDeleteProfileModal();">
                        Delete account
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div id="deleteProfileForm" class="d-none">
        <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
            @csrf

            <modal class="mt-5 background-image-group" id="deleteProfile" :is-open="modalIds.deleteProfile">
                <h3 slot="header">
                    {{ __('shop::app.customer.account.address.index.enter-password') }}
                </h3>

                <i class="rango-close"></i>

                <div slot="body">
                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                        <label for="password">{{ __('admin::app.users.users.password') }}</label>

                        <input type="password" v-validate="'required|min:6'" class="control profile-input form-control"
                               id="password"
                               name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>

                        <span class="control-error" v-if="errors.has('password')"
                              v-text="errors.first('password')"></span>
                    </div>

                    <div class="page-action">
                        <button type="submit" class="theme-btn mt-3 mb20">
                            {{ __('shop::app.customer.account.address.index.delete') }}
                        </button>
                    </div>
                </div>
            </modal>
        </form>
    </div>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!}

    @push('scripts')
        <script>
            $(document).ready(function(){
                let name = $('.profile-control-input');

                name.each(function() {
                    $(this).on('input', function () {
                        let phpName = "{{ $customer->first_name }}"
                        if ($(this).val() !== phpName) {
                            $('#submitBtn').prop('disabled', false);
                        }
                    });
                })
            })

            /**
             * Show delete profile modal.
             */
            function showDeleteProfileModal() {
                document.getElementById('deleteProfileForm').classList.remove('d-none');

                window.app.showModal('deleteProfile');
            }


        </script>
    @endpush

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}
@endsection
