@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.forget-password.dear', ['name' => $user_name]) }},
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.forget-password.info') }}:
    </p>

    <p class="center-container">
        <a href="{{ route('customer.reset-password.create', $token) }}">
            {{ __('shop::app.mail.forget-password.reset-password') }}
        </a>
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.forget-password.final-summary') }}.
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.forget-password.thanks') }}
    </p>

@endcomponent