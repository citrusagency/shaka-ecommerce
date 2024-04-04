@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear-admin', ['admin_name' => core()->getAdminEmailDetails()['name']]) }},
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.update-password.info') }}
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.update-password.thanks') }}
    </p>

@endcomponent