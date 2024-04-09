@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('notify::app.mail.dear')}},
    </p>

    <p class="p-text">
        {{ __('notify::app.mail.greeting') }}
    </p>

    <p class="p-text">
        {{ __('notify::app.mail.summary', ['product_name' => $product_name]) }}
    </p>

    <p class="p-text">
        {{ __('notify::app.mail.visit_us') }}
    </p>

    <p class="p-text w-pd">
        {{ __('notify::app.mail.thanks') }}
    </p>
@endcomponent