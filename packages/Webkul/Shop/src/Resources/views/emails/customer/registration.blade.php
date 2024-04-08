@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']]) }},
    </p>

    <p class="p-text">
        {!! __('shop::app.mail.customer.registration.greeting') !!}
    </p>

    <p class="p-text w-pd">
        {{ __('shop::app.mail.customer.registration.summary') }}
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.customer.registration.thanks') }}
    </p>

@endcomponent