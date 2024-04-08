@component('shop::emails.layouts.master')
    <?php $order = $refund->order; ?>


    <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
        <span style="font-weight: bold;">
            {{ __('shop::app.mail.refund.heading', ['order_id' => $order->increment_id, 'refund_id' => $refund->id]) }}
        </span> <br>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('shop::app.mail.order.dear', ['customer_name' => $order->customer_full_name]) }},
        </p>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {!! __('shop::app.mail.order.greeting', [
                'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #0041FF; font-weight: bold;">#' . $order->increment_id . '</a>',
                'created_at' => $order->created_at
                ])
            !!}
        </p>
    </div>

    <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
        {{ __('shop::app.mail.refund.summary') }}
    </div>

    @include('shop::emails.layouts.order-details',['order' => $order])
    @include('shop::emails.layouts.refund-summary',['order' => $order, 'refund' => $refund])
    @include('shop::emails.layouts.thanks')
@endcomponent
