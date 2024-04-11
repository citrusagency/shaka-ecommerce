@component('shop::emails.layouts.master')

        <p class="p-text">
            {{ __('shop::app.mail.customer.new.dear', ['customer_name' => $customer['name']]) }},
        </p>

        <div>
            {!! __('shop::app.mail.invoice.reminder.your-invoice-is-overdue', ['invoice' => $invoice->increment_id, 'time' => $invoice->created_at->diffForHumans()]) !!}
        </div>

        <div>
        {!! __('shop::app.mail.invoice.reminder.please-make-your-payment-as-soon-as-possible') !!}
        </div>

        <div>
        {!! __('shop::app.mail.invoice.reminder.if-you-ve-already-paid-just-disregard-this-email') !!}
        </div>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('shop::app.mail.customer.new.thanks') }}
        </p>

@endcomponent