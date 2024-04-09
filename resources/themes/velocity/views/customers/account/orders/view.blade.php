@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id]) }}
@endsection

@push('css')
    <style type="text/css">
        .account-content .account-layout .account-head {
            margin-bottom: 0px;
        }

        .sale-summary .dash-icon {
            margin-right: 30px;
            float: right;
        }
    </style>
@endpush

@section('page-detail-wrapper')
    <div class="account-head mb-lg-5">
        <div class="d-flex account-head">
            <a class="px-3"
               href="{{ route('customer.orders.index') }}"> {!! file_get_contents(public_path('images/Icon.svg')) !!}
            </a>
            <h4 class=" font-weight-bold account-heading">Orders</h4>
        </div>
        {{--        CANCEL ORDER CONFIRMATION --}}
        @if ($order->canCancel())
            <div class="account-action">
                <form id="cancelOrderForm" action="{{ route('customer.orders.cancel', $order->id) }}" method="post">
                    @csrf
                </form>

                <a href="javascript:void(0);" class="theme-btn rounded float-right"
                   onclick="cancelOrder('{{ __('shop::app.customer.account.order.view.cancel-confirm-msg') }}')"
                   style="float: right">
                    {{ __('shop::app.customer.account.order.view.cancel-btn-title') }}
                </a>
            </div>
        @endif
    </div>
    {!! view_render_event('bagisto.shop.customers.account.orders.view.before', ['order' => $order]) !!}

    <div class="container">
        <tabs>
            <tab name="{{ __('shop::app.customer.account.order.view.info') }}" :selected="true">
                <div class="sale-section">
                    <div class="section-content">
                        <div class="row col-12">
                            <label class="control-label">
                                {{ __('shop::app.customer.account.order.view.placed-on') }}
                            </label>
                            <span class="value">
                                {{ core()->formatDate($order->created_at, 'd M Y') }}
                                Order ID: {{ $order->id }}
                                Total cost: {{ $order->grand_total }}
                                Order date:{{ core()->formatDate($order->created_at, 'd M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="sale-section mt-5">
                    <div class="section-title">
                        <h5>Order {{ $order->increment_id }} details:</h5>
                        <p> Status: {{ $order->status }} </p>
                    </div>
                    {{--                    {{ dd($order) }}--}}
                    <div class="section-content mt-3">
                        <div class="d-lg-flex">

                            @foreach ($order->items as $item)
                                <div class="card mb-3 col" style="max-width: 18rem">
                                    <div class="card-header bg-transparent">
                                        Product ID: {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                    </div>
                                    <p class="card-title"> {{ $item->name }} </p>
                                    <div class="p-2 text-secondary">
                                        <p> Quantity: {{ $item->qty_ordered }} </p>
                                        <p> {{ core()->formatPrice($item->price, $order->order_currency_code) }}</p>
                                        <p>Delivery: {{ $order->shipping_description }} </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-secondary">
                                        SubTotal: {{ core()->formatPrice($item->total, $order->order_currency_code) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="totals table table-striped accordion-header">
                            <h3 class="table-heading">Total</h3>
                            <table class="sale-summary">
                                <tbody>
                                <tr>
                                    <td>{{ __('shop::app.customer.account.order.view.subtotal') }}
                                        <span class="dash-icon">-</span>
                                    </td>
                                    <td>{{ core()->formatPrice($order->sub_total, $order->order_currency_code) }}</td>
                                </tr>

                                @if ($order->haveStockableItems())
                                    <tr>
                                        <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                            <span class="dash-icon">-</span>
                                        </td>
                                        <td>{{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}</td>
                                    </tr>
                                @endif

                                @if ($order->base_discount_amount > 0)
                                    <tr>
                                        <td>{{ __('shop::app.customer.account.order.view.discount') }}
                                            @if ($order->coupon_code)
                                                ({{ $order->coupon_code }})
                                            @endif
                                            <span class="dash-icon">-</span>
                                        </td>
                                        <td>{{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}</td>
                                    </tr>
                                @endif

                                <tr class="border-bottom">
                                    <td>{{ __('shop::app.customer.account.order.view.tax') }}
                                        <span class="dash-icon">-</span>
                                    </td>
                                    <td>{{ core()->formatPrice($order->tax_amount, $order->order_currency_code) }}</td>
                                </tr>

                                <tr class="fw6">
                                    <td>{{ __('shop::app.customer.account.order.view.grand-total') }}
                                        <span class="dash-icon">-</span>
                                    </td>
                                    <td>{{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}</td>
                                </tr>

                                <tr class="fw6">
                                    <td>{{ __('shop::app.customer.account.order.view.total-paid') }}
                                        <span class="dash-icon">-</span>
                                    </td>
                                    <td>{{ core()->formatPrice($order->grand_total_invoiced, $order->order_currency_code) }}</td>
                                </tr>

                                <tr class="fw6">
                                    <td>{{ __('shop::app.customer.account.order.view.total-refunded') }}
                                        <span class="dash-icon">-</span>
                                    </td>
                                    <td>{{ core()->formatPrice($order->grand_total_refunded, $order->order_currency_code) }}</td>
                                </tr>

                                <tr class="fw6">
                                    <td>{{ __('shop::app.customer.account.order.view.total-due') }}
                                        <span class="dash-icon">-</span>
                                    </td>

                                    @if($order->status !== 'canceled')
                                        <td>{{ core()->formatPrice($order->total_due, $order->order_currency_code) }}</td>
                                    @else
                                        <td>{{ core()->formatPrice(0.00, $order->order_currency_code) }}</td>
                                    @endif
                                </tr>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </tab>

            @if ($order->invoices->count())
                <tab name="{{ __('shop::app.customer.account.order.view.invoices') }}">

                    @foreach ($order->invoices as $invoice)

                        <div class="sale-section">
                            <div class="section-title">
                                <span>{{ __('shop::app.customer.account.order.view.individual-invoice', ['invoice_id' => $invoice->increment_id ?? $invoice->id]) }}</span>

                                <a href="{{ route('customer.orders.print', $invoice->id) }}" class="float-right">
                                    {{ __('shop::app.customer.account.order.view.print') }}
                                </a>
                            </div>

                            <div class="section-content">
                                <div class="table">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($invoice->items as $item)
                                            <tr>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">
                                                    {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">
                                                    {{ $item->name }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">
                                                    {{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">
                                                    {{ $item->qty }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">
                                                    {{ core()->formatPrice($item->total, $order->order_currency_code) }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">
                                                    {{ core()->formatPrice($item->tax_amount, $order->order_currency_code) }}
                                                </td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">
                                                    {{ core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="totals">
                                    <table class="sale-summary">
                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.subtotal') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($invoice->sub_total, $order->order_currency_code) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($invoice->shipping_amount, $order->order_currency_code) }}</td>
                                        </tr>

                                        @if ($invoice->base_discount_amount > 0)
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}
                                                    <span class="dash-icon">-</span>
                                                </td>
                                                <td>{{ core()->formatPrice($invoice->discount_amount, $order->order_currency_code) }}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.tax') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($invoice->tax_amount, $order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="fw6">
                                            <td>{{ __('shop::app.customer.account.order.view.grand-total') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($invoice->grand_total, $order->order_currency_code) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </tab>
            @endif

            @if ($order->shipments->count())
                <tab name="{{ __('shop::app.customer.account.order.view.shipments') }}">

                    @foreach ($order->shipments as $shipment)

                        <div class="sale-section">
                            <div class="section-content">
                                <div class="row col-12">
                                    <label class="mr20">
                                        {{ __('shop::app.customer.account.order.view.tracking-number') }}
                                    </label>

                                    <span class="value">
                                        {{  $shipment->track_number }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="sale-section">
                            <div class="section-title">
                                <span>{{ __('shop::app.customer.account.order.view.individual-shipment', ['shipment_id' => $shipment->id]) }}</span>
                            </div>

                            <div class="section-content">
                                <div class="table">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach ($shipment->items as $item)

                                            <tr>
                                                <td data-value="{{  __('shop::app.customer.account.order.view.SKU') }}">{{ $item->sku }}</td>
                                                <td data-value="{{  __('shop::app.customer.account.order.view.product-name') }}">{{ $item->name }}</td>
                                                <td data-value="{{  __('shop::app.customer.account.order.view.qty') }}">{{ $item->qty }}</td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </tab>
            @endif
            @if ($order->refunds->count())
                <tab name="{{ __('shop::app.customer.account.order.view.refunds') }}">

                    @foreach ($order->refunds as $refund)

                        <div class="sale-section">
                            <div class="section-title">
                                <span>{{ __('shop::app.customer.account.order.view.individual-refund', ['refund_id' => $refund->id]) }}</span>
                            </div>

                            <div class="section-content">
                                <div class="table">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($refund->items as $item)
                                            <tr>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">{{ $item->child ? $item->child->sku : $item->sku }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">{{ $item->name }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">{{ core()->formatPrice($item->price, $order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">{{ $item->qty }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">{{ core()->formatPrice($item->total, $order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">{{ core()->formatPrice($item->tax_amount, $order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">{{ core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code) }}</td>
                                            </tr>
                                        @endforeach
                                        @if (! $refund->items->count())
                                            <tr>
                                                <td class="empty"
                                                    colspan="7">{{ __('shop::app.common.no-result-found') }}</td>
                                            <tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="totals">
                                    <table class="sale-summary">
                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.subtotal') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($refund->sub_total, $order->order_currency_code) }}</td>
                                        </tr>

                                        @if ($refund->shipping_amount > 0)
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                                    <span class="dash-icon">-</span>
                                                </td>
                                                <td>{{ core()->formatPrice($refund->shipping_amount, $order->order_currency_code) }}</td>
                                            </tr>
                                        @endif
                                        @if ($refund->discount_amount > 0)
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}
                                                    <span class="dash-icon">-</span>
                                                </td>
                                                <td>{{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}</td>
                                            </tr>
                                        @endif
                                        @if ($refund->tax_amount > 0)
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.tax') }}
                                                    <span class="dash-icon">-</span>
                                                </td>
                                                <td>{{ core()->formatPrice($refund->tax_amount, $order->order_currency_code) }}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.adjustment-refund') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($refund->adjustment_refund, $order->order_currency_code) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.adjustment-fee') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($refund->adjustment_fee, $order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="fw6">
                                            <td>{{ __('shop::app.customer.account.order.view.grand-total') }}
                                                <span class="dash-icon">-</span>
                                            </td>
                                            <td>{{ core()->formatPrice($refund->grand_total, $order->order_currency_code) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tab>
            @endif
        </tabs>
    </div>

    <div class="d-flex">
        @if ($order->billing_address)
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('shop::app.customer.account.order.view.billing-address') }}
                </div>
                <div class="card-body text-secondary">
                    <p class="card-text">
                        @include ('admin::sales.address', ['address' => $order->billing_address])
                    </p>
                    <div class="card-text">
                        <h5 class="mt-2"> {{ __('shop::app.customer.account.order.view.payment-method') }} </h5>
                        {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                        @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp
                        @if (! empty($additionalDetails))
                            <div class="instructions">
                                <label>{{ $additionalDetails['title'] }}</label>
                                <p>{{ $additionalDetails['value'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if ($order->shipping_address)
            <div class="card border-secondary ml-md-3 mb-3">
                <div class="card-header">
                    {{ __('shop::app.customer.account.order.view.shipping-address') }}
                </div>

                <div class="card-body">
                    <div class="card-text">
                        @include ('admin::sales.address', ['address' => $order->shipping_address])
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-address.after', ['order' => $order]) !!}

                    <div class="card-title">
                        {{ __('shop::app.customer.account.order.view.shipping-method') }}
                    </div>

                    <div class="card-text">
                        {{ $order->shipping_title }}
                        {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-method.after', ['order' => $order]) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
    {!! view_render_event('bagisto.shop.customers.account.orders.view.after', ['order' => $order]) !!}
@endsection

@push('scripts')
    <script>
        function cancelOrder(message) {
            if (!confirm(message)) {
                return;
            }

            $('#cancelOrderForm').submit();
        }
    </script>
@endpush