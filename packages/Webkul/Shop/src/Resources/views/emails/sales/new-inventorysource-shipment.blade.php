@component('shop::emails.layouts.master')
    <?php $order = $shipment->order; ?>

    <p class="headings">
        {{ __('shop::app.mail.shipment.heading', ['order_id' => $order->increment_id, 'shipment_id' => $shipment->id]) }}
    </p>

    <p class="p-text">
        {{ __('shop::app.mail.order.dear', ['customer_name' => $order->customer_full_name]) }},
    </p>

    <p class="p-text" style="margin-top: 5px!important;">
        {!! __('shop::app.mail.order.greeting', [
            'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '"style="color: #1197C2; font-weight: bold;">#' . $order->increment_id . '</a>',
            'created_at' => $order->created_at->format('d.m.Y').' at '.$order->created_at->format('H:i:s').'.'
            ])
        !!}
    </p>

    <p class="headings">
        {{ __('shop::app.mail.shipment.summary') }}
    </p>

    @include('shop::emails.layouts.order-details',['order' => $order])
    @include('shop::emails.layouts.products-table',['order' => $order])

@endcomponent