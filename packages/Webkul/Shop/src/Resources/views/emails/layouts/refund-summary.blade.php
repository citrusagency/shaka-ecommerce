<div class="cost-section">
    <div>
        <span>{{ __('shop::app.mail.order.subtotal') }}</span>
        <span style="float: right;">
                {{ core()->formatPrice($refund->sub_total, $refund->order_currency_code) }}
            </span>
    </div>

    @if ($order->shipping_address)
        <div>
            <span>{{ __('shop::app.mail.order.shipping-handling') }}</span>
            <span style="float: right;">
                    {{ core()->formatPrice($refund->shipping_amount, $refund->order_currency_code) }}
                </span>
        </div>
    @endif

    @if ($refund->tax_amount > 0)
        @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($refund, false) as $taxRate => $taxAmount)
            <div>
                <span>{{ __('shop::app.mail.order.tax') }}</span>
                <span style="float: right;">
                    {{ core()->formatPrice($refund->tax_amount, $refund->order_currency_code) }}
                </span>
            </div>
        @endforeach
    @endif

    @if ($refund->discount_amount > 0)
        <div>
            <span>{{ __('shop::app.mail.order.discount') }}</span>
            <span style="float: right;">
                    {{ core()->formatPrice($refund->discount_amount, $refund->order_currency_code) }}
                </span>
        </div>
    @endif

    @if ($refund->adjustment_refund > 0)
        <div>
            <span>{{ __('shop::app.mail.refund.adjustment-refund') }}</span>
            <span style="float: right;">
                    {{ core()->formatPrice($refund->adjustment_refund, $refund->order_currency_code) }}
                </span>
        </div>
    @endif

    @if ($refund->adjustment_fee > 0)
        <div>
            <span>{{ __('shop::app.mail.refund.adjustment-fee') }}</span>
            <span style="float: right;">
                    {{ core()->formatPrice($refund->adjustment_fee, $refund->order_currency_code) }}
                </span>
        </div>
    @endif

    <div style="font-weight: bold">
        <span>{{ __('shop::app.mail.order.grand-total') }}</span>
        <span style="float: right;">
                {{ core()->formatPrice($refund->grand_total, $refund->order_currency_code) }}
            </span>
    </div>
</div>