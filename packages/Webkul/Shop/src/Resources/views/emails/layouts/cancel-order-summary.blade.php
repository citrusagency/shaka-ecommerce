<div class="cost-section">
    <div>
        <span>{{ __('shop::app.mail.order.cancel.subtotal') }}</span>
        <span style="float: right;">
                    {{ core()->formatPrice($order->sub_total, $order->order_currency_code) }}
                </span>
    </div>

    <div>
        <span>{{ __('shop::app.mail.order.cancel.shipping-handling') }}</span>
        <span style="float: right;">
                    {{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}
                </span>
    </div>

    @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($order, false) as $taxRate => $taxAmount )
        <div>
            <span id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ __('shop::app.mail.order.cancel.tax') }} {{ $taxRate }} %</span>
            <span id="taxamount-{{ core()->taxRateAsIdentifier($taxRate) }}" style="float: right;">
                    {{ core()->formatPrice($taxAmount, $order->order_currency_code) }}
                </span>
        </div>
    @endforeach

    @if ($order->discount_amount > 0)
        <div>
            <span>{{ __('shop::app.mail.order.cancel.discount') }}</span>
            <span style="float: right;">
                        {{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}
                    </span>
        </div>
    @endif

    <div style="font-weight: bold">
        <span>{{ __('shop::app.mail.order.cancel.grand-total') }}</span>
        <span style="float: right;">
            {{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}
        </span>
    </div>
</div>