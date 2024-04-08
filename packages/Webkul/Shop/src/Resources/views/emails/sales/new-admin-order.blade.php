@component('shop::emails.layouts.master')
    <p class="headings">
        {{ __('shop::app.mail.order.heading') }}
    </p>
    <br>
    <p class="p-text" style="margin-top: 5px!important;">
        {!! __('shop::app.mail.order.greeting-admin', [
            'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #1197C2; font-weight: bold;">#' . $order->increment_id . '</a>',
            'created_at' => $order->created_at->format('d.m.Y').' at '.$order->created_at->format('H:i:s').'.'
            ])
        !!}
    </p>

    <div style="display: flex; align-items: center; justify-content: left;">
        <p class="headings">
            {{ __('shop::app.mail.order.summary') }}
        </p>
        <hr>
    </div>

    @include('shop::emails.layouts.order-details',['order' => $order])
    @include('shop::emails.layouts.products-table',['order' => $order])
    @include('shop::emails.layouts.cost-summary',['order' => $order])

    <div style="width: 100%;display: inline-block;">
    </div>
@endcomponent
