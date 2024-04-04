@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="profile-content-title float-left">
        {{ __('shop::app.customer.account.profile.index.title') }}
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

    <form
        class="profile-form mt-5"
        method="POST"
        @submit.prevent="onSubmit"
        action="{{ route('customer.profile.store') }}"
        enctype="multipart/form-data">

        <div class="account-table-content">
            @csrf
            {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}

            <div class="border rounded p-3 col-12 d-lg-flex d-sm-block">
                <div class="col-lg-6 col-md-12">
                    <div :class="`form-group ${errors.has('first_name') ? 'has-error' : ''}`">
                        <label class="mandatory form-label">
                            {{ __('shop::app.customer.account.profile.fname') }}
                        </label>


                        <input value="{{ $customer->first_name }}"
                               class="profile-control-input profile-input form-control"
                               name="first_name"
                               type="text" v-validate="'required'" id="first_name"
                               data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('first_name')"
                              v-text="errors.first('first_name')"></span>

                    </div>
                    {!! view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after', ['customer' => $customer]) !!}

                    <div :class="`form-group ${errors.has('last_name') ? 'has-error' : ''}`">
                        <label class="mandatory form-label">
                            {{ __('shop::app.customer.account.profile.lname') }}
                        </label>

                        <input value="{{ $customer->last_name }}"
                               class="profile-control-input profile-input form-control"
                               name="last_name"
                               type="text" v-validate="'required'"
                               data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('last_name')"
                              v-text="errors.first('last_name')"></span>

                    </div>
                    {!! view_render_event('bagisto.shop.customers.account.profile.edit.last_name.after', ['customer' => $customer]) !!}

                </div>


                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="mandatory form-label">
                            {{ __('shop::app.customer.account.profile.email') }}
                        </label>

                        <input class="profile-control-input profile-input form-control" value="{{ $customer->email }}"
                               name="email" type="text"
                               v-validate="'required'"/>
                        <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
                    </div>
                    {!! view_render_event('bagisto.shop.customers.account.profile.edit.email.after', ['customer' => $customer]) !!}

                    <div class="form-group">
                        <label class="form-label">
                            {{ __('shop::app.customer.account.profile.phone') }}
                        </label>

                        <input class="profile-control-input profile-input form-control"
                               value="{{ old('phone') ?? $customer->phone }}" name="phone" type="text"/>
                        <span class="control-error" v-if="errors.has('phone')" v-text="errors.first('phone')"></span>
                    </div>
                    {!! view_render_event('bagisto.shop.customers.account.profile.edit.phone.after', ['customer' => $customer]) !!}
                </div>
            </div>

            {{--           ~~~~~~~~~~~~~~~~~~~~~ PASSWORD ~~~~~~~~~~~~~~~~~~~~~--}}

            <div class="card border rounded  mt-4 d-lg-flex d-sm-block">
                <p class="card-header">Change password</p>
                <div class="card-body d-lg-flex">
                    <div class="col-lg-6 col-md-12 form-group">

                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label">
                                    Current password
                                </label>

                                <div :class="`${errors.has('oldpassword') ? 'has-error' : ''}`">
                                    <input class="profile-input form-control password" value="" name="oldpassword"
                                           type="password"/>
                                </div>

                            </div>

                            {!! view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after', ['customer' => $customer]) !!}

                            <div class="">
                                <label class="form-label">
                                    {{ __('velocity::app.shop.general.new-password') }}
                                </label>

                                <div :class="`${errors.has('password') ? 'has-error' : ''}`">
                                    <input
                                        class="profile-control-input profile-input form-control password"
                                        name="password"
                                        ref="password"
                                        type="password"
                                        v-validate="'min:6'"/>

                                    <span class="control-error" v-if="errors.has('password')"
                                          v-text="errors.first('password')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-row col-lg-6 col-md-12">
                        <div class="form-group">
                            <label class="form-label">
                                {{ __('velocity::app.shop.general.confirm-new-password') }}
                            </label>

                            <div
                                :class="`${errors.has('password_confirmation') ? 'has-error' : ''}`">
                                <input class="profile-control-input profile-input form-control password" value=""
                                       name="password_confirmation"
                                       type="password"
                                       v-validate="'min:6|confirmed:password'" data-vv-as="confirm password"/>

                                <span class="control-error" v-if="errors.has('password_confirmation')"
                                      v-text="errors.first('password_confirmation')"></span>
                            </div>
                        </div>
                        <div class="form-group align-self-auto" style="margin-top: 65px">
                            <input type="checkbox" onclick="showPassword()" class="shaka-checkbox" name="" id="">
                            <span>Show Password</span>
                        </div>
                    </div>
                </div>


                {!! view_render_event('bagisto.shop.customers.account.profile.edit.password.after', ['customer' => $customer]) !!}
                {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}

            </div>
            <div class="">
                <button
                    type="submit"
                    id="submitBtn"
                    class="theme-btn col-lg-6 col-md-12 my-3" disabled>
                    Save
                </button>

                <button
                    type="submit"
                    class="theme-btn col-lg-6 col-md-12 mb-3"
                    onclick="window.showDeleteProfileModal();">
                    Delete account
                </button>
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

    {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!}

    @push('scripts')
        <script>
            $(document).ready(function () {
                let name = $('.profile-control-input');

                name.each(function () {
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

    {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}
@endsection
