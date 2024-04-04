@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear-admin', ['admin_name' => core()->getAdminEmailDetails()['name']]) }},
    </p>

    <p class="p-text">
        Customer: {{ $user_name }}, has forgotten his/her password, and requested for reset of password.
    </p>

@endcomponent