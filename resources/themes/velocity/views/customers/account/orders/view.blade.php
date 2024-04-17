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

    </div>
    {!! view_render_event('bagisto.shop.customers.account.orders.view.before', ['order' => $order]) !!}

    <div class="container">
        <tabs>
            <tab name="{{ __('shop::app.customer.account.order.view.info') }}" :selected="true">
                <div class="sale-section mt-4">
                    <div class="table-responsive section-title">
                        <div class="card border-0">
                            <div class="card-header bg-transparent">
                                <table class="table bg-transparent table-light text-secondary">
                                    <thead>
                                    <tr class="font-weight-bold">
                                        <td>Status:</td>
                                        <td>Order number:</td>
                                        <td>Order date:</td>
                                        <td>Total cost:</td>
                                        <td>Delivery:</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $order->status }}</td>
                                        <td>#{{ $order->increment_id }}</td>
                                        <td>{{ core()->formatDate($order->created_at, 'd M Y') }}</td>
                                        <td>{{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}</td>
                                        <td>{{ core()->formatPrice($order->shipping_amount, $order->order_currency_code ) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-start">
                                    @foreach ($order->items as $item)
                                        @php
                                            $image = productimage()->getGalleryImages($item->product);
                                        @endphp
                                        <div class="card border-0 my-2 col-lg-5 col-md-6 col-sm-12">
                                            <div class="card-header bg-transparent">
                                                Product ID: {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                            </div>

                                            <div class="card-body d-flex">
                                                <div class="product-image">
                                                    <img style="height: 150px" src="{{$image[0]['small_image_url']}}"
                                                         alt="imagee">
                                                </div>
                                                <div class="p-2">
                                                    <p class="card-title"> {{ $item->name }} </p>
                                                    <p class="text-secondary"> Quantity: {{ $item->qty_ordered }} </p>
                                                    <p class="text-secondary"> {{ core()->formatPrice($item->price, $order->order_currency_code) }}</p>
                                                </div>
                                            </div>

                                            <div class="card-footer bg-transparent">
                                                SubTotal: {{ core()->formatPrice($item->total, $order->order_currency_code) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>

            @if ($order->invoices->count())
                <tab name="{{ __('shop::app.customer.account.order.view.invoices') }}">

                    @foreach ($order->invoices as $invoice)
                        <div class="my-4 outline section-title">
                            <h5>Order #{{ $order->increment_id }} details:</h5>

                            <p>{{ __('shop::app.customer.account.order.view.individual-invoice', ['invoice_id' => $invoice->increment_id ?? $invoice->id]) }}</p>
                            <a href="{{ route('customer.orders.print', $invoice->id) }}" class="rounded">
                                {{ __('shop::app.customer.account.order.view.print') }}
                            </a>
                        </div>
                    @endforeach

                    <div class="mt-lg-3 totals table table-striped">
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


                </tab>
            @endif

            @if ($order->shipments->count())
                <tab name="{{ __('shop::app.customer.account.order.view.shipments') }}">
                    @foreach ($order->shipments as $shipment)
                        <div class="my-4 outline section-title">
                            <h5>Order #{{ $order->increment_id }} details:</h5>

                            <p>{{ __('shop::app.customer.account.order.view.individual-shipment', ['shipment_id' => $shipment->id]) }}</p>
                            <p class="mr-3">{{ __('shop::app.customer.account.order.view.tracking-number') }}</p>

                            <p class="value"> {{  $shipment->track_number }} </p>

                            <button class="my-3 col-lg-3 col-md-6 col-sm-12 btn theme-btn">Track my order</button>
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
    {{--Bottom cards --}}
    <div class="container d-sm-grid d-md-flex p-3">
        @if ($order->billing_address)
            <div class="card border-0 mr-lg-3 my-2 col-lg-4 col-md-6 col-sm-12">
                <div class="card-header bg-transparent">
                    {{ __('shop::app.customer.account.order.view.billing-address') }}
                </div>
                <div class="card-body pt-0">
                    @include ('admin::sales.address', ['address' => $order->billing_address])
                </div>
                <div class="card-footer bg-transparent">
                    <p class=""> {{ __('shop::app.customer.account.order.view.payment-method') }} </p>
                    <p>
                        {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                    </p>
                    @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp
                    @if (! empty($additionalDetails))
                        <div class="instructions">
                            <p>{{ $additionalDetails['title'] }}</p>
                            <p>{{ $additionalDetails['value'] }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if ($order->shipping_address)
            <div class="card border-0 mr-lg-3 my-2 col-lg-4 col-md-6 col-sm-12">
                <div class="card-header bg-transparent">
                    {{ __('shop::app.customer.account.order.view.shipping-address') }}
                </div>
                <div class="card-body pt-0">
                    @include ('admin::sales.address', ['address' => $order->shipping_address])
                    {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-address.after', ['order' => $order]) !!}
                </div>
                <div class="card-footer bg-transparent ">
                    <p class="">
                        {{ __('shop::app.customer.account.order.view.shipping-method') }}
                    </p>
                    <p class="">
                        {{ $order->shipping_title }}
                        {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-method.after', ['order' => $order]) !!}
                    </p>
                </div>
            </div>
        @endif
        {{--        CANCEL ORDER CONFIRMATION --}}
        @if ($order->canCancel())
            <div class="align-self-end col-3 p-md-0 ml-sm-2 ml-md-0 mb-lg-3 ml-lg-auto">
                <form id="cancelOrderForm" action="{{ route('customer.orders.cancel', $order->id) }}" method="post">
                    @csrf
                </form>

                <a href="javascript:void(0);" class="btn btn-outline-danger rounded float-right"
                   onclick="cancelOrder('{{ __('shop::app.customer.account.order.view.cancel-confirm-msg') }}')">
                    Cancel order </a>
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