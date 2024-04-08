@component('shop::emails.layouts.master')
    <p class="dear-customer">
        {{ __('shop::app.mail.order.comment.dear', ['customer_name' => $comment->order->customer_full_name]) }},
    </p>

    <p class="p-text" style="font-style: italic;">
        {{ $comment->comment }}
    </p>

    @include('shop::emails.layouts.thanks')
@endcomponent
