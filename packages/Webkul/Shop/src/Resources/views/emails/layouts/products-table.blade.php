<div class="section-content">
    <div class="table mb-20">
        <table class="order-table">
            <thead>
            <tr style="background-color: #232427; color:#fff;">
                <th class="table-th">{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                <th class="table-th">{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                <th class="table-th">{{ __('shop::app.customer.account.order.view.price') }}</th>
                <th class="table-th">{{ __('shop::app.customer.account.order.view.qty') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}" class="table-td">
                        {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                    </td>

                    <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}" class="table-td">
                        {{ $item->name }}
                    </td>

                    <td data-value="{{ __('shop::app.customer.account.order.view.price') }}" class="table-td">
                        {{ core()->formatPrice($item->price, $order->order_currency_code) }}
                    </td>

                    <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}" class="table-td">
                        {{ $item->qty_ordered }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<hr style="margin-top:20px; margin-bottom:20px;border-radius: 50%; border: 2px double rgba(36,36,36,0.79);"/>