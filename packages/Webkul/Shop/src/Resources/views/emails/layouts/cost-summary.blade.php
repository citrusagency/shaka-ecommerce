<div class="cost-section">
    <div>
        <span>{{ __('shop::app.mail.order.subtotal') }}</span>
        <span style="float: right;">
            {{ core()->formatBasePrice($order->base_sub_total) }}
        </span>
    </div>

    <div>
        <span>{{ __('shop::app.mail.order.shipping-handling') }}</span>
        <span style="float: right;">
            {{ core()->formatBasePrice($order->base_shipping_amount) }}
        </span>
    </div>

    @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($order, true) as $taxRate => $baseTaxAmount )
        <div>
            <span id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ __('shop::app.mail.order.tax') }} {{ $taxRate }} %</span>
            <span id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}" style="float: right;">
            {{ core()->formatBasePrice($baseTaxAmount) }}
        </span>
        </div>
    @endforeach

    @if ($order->discount_amount > 0)
        <div>
            <span>{{ __('shop::app.mail.order.discount') }}</span>
            <span style="float: right;">
                {{ core()->formatBasePrice($order->base_discount_amount) }}
            </span>
        </div>
    @endif

    <div style="font-weight: bold">
        <span>{{ __('shop::app.mail.order.grand-total') }}</span>
        <span style="float: right;">
            {{ core()->formatBasePrice($order->base_grand_total) }}
        </span>
    </div>
</div>