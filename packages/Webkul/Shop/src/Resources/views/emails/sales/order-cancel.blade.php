@component('shop::emails.layouts.master')
        <p class="headings">
            {{ __('shop::app.mail.order.cancel.heading') }}
        </p>
        <br>
        <p class="p-text">
            {{ __('shop::app.mail.order.cancel.dear', ['customer_name' => $order->customer_full_name]) }},
        </p>
        <p class="p-text" style="margin-top: 5px!important;">
            {!! __('shop::app.mail.order.cancel.greeting', [
                'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #1197C2; font-weight: bold;">#' . $order->increment_id . '</a>',
                'created_at' => $order->created_at->format('d.m.Y').' at '.$order->created_at->format('H:i:s').'.'
                ])
            !!}
        </p>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            {{ __('shop::app.mail.order.cancel.summary') }}
        </div>

        @include('shop::emails.layouts.order-details',['order' => $order])
        @include('shop::emails.layouts.products-table',['order' => $order])
        @include('shop::emails.layouts.cancel-order-summary',['order' => $order])
        @include('shop::emails.layouts.thanks', ['text'=> 'order.cancel.final-summary'])

@endcomponent
