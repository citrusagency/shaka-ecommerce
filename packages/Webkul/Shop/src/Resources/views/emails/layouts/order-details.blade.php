<div class="address-data">
    @if ($order->shipping_address)
        <div style="line-height: 25px;">
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('shop::app.mail.order.shipping-address') }}
            </div>
            <div>
                {{ $order->shipping_address->company_name ?? '' }}
            </div>
            <div>
                {{ $order->shipping_address->name }}
            </div>
            <div>
                {{ $order->shipping_address->address1 }}
            </div>
            <div>
                {{ $order->shipping_address->postcode . " " . $order->shipping_address->city }}
            </div>
            <div>
                {{ $order->shipping_address->state }}
            </div>
            <div>
                {{ core()->country_name($order->shipping_address->country) }}
            </div>
            <div>---</div>
            <div style="margin-bottom: 40px;">
                {{ __('shop::app.mail.order.contact') }} : {{ $order->shipping_address->phone }}
            </div>
            <div style="font-size: 16px;color: #242424;">
                {{ __('shop::app.mail.order.shipping') }}
            </div>
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ $order->shipping_title }}
            </div>
        </div>
    @endif

    @if ($order->billing_address)
        <div style="line-height: 25px;">
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('shop::app.mail.order.billing-address') }}
            </div>
            <div>
                {{ $order->billing_address->company_name ?? '' }}
            </div>
            <div>
                {{ $order->billing_address->name }}
            </div>
            <div>
                {{ $order->billing_address->address1 }}
            </div>
            <div>
                {{ $order->billing_address->postcode . " " . $order->billing_address->city }}
            </div>
            <div>
                {{ $order->billing_address->state }}
            </div>
            <div>
                {{ core()->country_name($order->billing_address->country) }}
            </div>
            <div>---</div>
            <div style="margin-bottom: 40px;">
                {{ __('shop::app.mail.order.contact') }} : {{ $order->billing_address->phone }}
            </div>
            <div style="font-size: 16px; color: #242424;">
                {{ __('shop::app.mail.order.payment') }}
            </div>
            <div style="font-weight: bold; font-size: 16px; color: #242424; margin-bottom: 20px;">
                {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
            </div>
            @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp
            @if (! empty($additionalDetails))
                <div style="font-size: 16px; color: #242424;">
                    <div>{{ $additionalDetails['title'] }}</div>
                    <div>{{ $additionalDetails['value'] }}</div>
                </div>
            @endif
        </div>
    @endif
</div>