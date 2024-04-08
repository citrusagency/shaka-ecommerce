@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']]) }},
    </p>

    <p class="p-text">
        {!! __('shop::app.mail.customer.new.summary') !!}
    </p>

    <p class="center-container">
        <b> {!! __('shop::app.mail.customer.new.username-email') !!} </b> - {{ $customer['email'] }} <br>
        <b> {!! __('shop::app.mail.customer.new.password') !!} </b> - {{ $password}}
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.customer.new.thanks') }}
    </p>

@endcomponent