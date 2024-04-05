@component('shop::emails.layouts.master')

    <p class="p-text">
        {!! __('shop::app.mail.customer.subscription.greeting') !!}
    </p>

    <p class="p-text">
        {{ $data['content'] }}
    </p>

    <p class="p-text w-pd">
        {!! __('shop::app.mail.customer.subscription.summary') !!}
    </p>

    <p class="center-container">
        <a href="{{ route('shop.unsubscribe', $data['token']) }}">
            {!! __('shop::app.mail.customer.subscription.unsubscribe') !!}
        </a>
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.forget-password.thanks') }}
    </p>

@endcomponent