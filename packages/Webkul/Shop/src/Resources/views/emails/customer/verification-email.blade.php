@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']]) }},
    </p>

    <p  class="ver-heading">
        {!! __('shop::app.mail.customer.verification.heading') !!}
    </p>

    <p class="p-text w-pd">
        {!! __('shop::app.mail.customer.verification.summary') !!}
    </p>

    <p  class="center-container">
        <a href="{{ route('customer.verify', $data['token']) }}">
            {!! __('shop::app.mail.customer.verification.verify') !!}
        </a>
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.customer.registration.thanks') }}
    </p>

@endcomponent