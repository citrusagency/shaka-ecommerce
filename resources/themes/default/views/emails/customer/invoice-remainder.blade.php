@component('shop::emails.layouts.master')

    <p class="dear-customer">
        {{ __('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']]) }},
    </p>

    <p class="p-text">
        {!! __('shop::app.mail.invoice.reminder.your-invoice-is-overdue', ['invoice' => $invoice->increment_id, 'time' => $invoice->created_at->diffForHumans()]) !!}
    </p>

    <p class="p-text w-pd">
    {!! __('shop::app.mail.invoice.reminder.please-make-your-payment-as-soon-as-possible') !!}
    </p>

    <p class="p-text">
    {!! __('shop::app.mail.invoice.reminder.if-you-ve-already-paid-just-disregard-this-email') !!}
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.customer.registration.thanks') }}
    </p>

@endcomponent