@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.order.index.page-title') }}
@endsection

@section('page-detail-wrapper')
    <div class="profile-content-title">
            {{ __('shop::app.customer.account.order.index.title') }}
    </div>

    {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

        <div class="">
            <div class="">
                <datagrid-plus src="{{ route('customer.orders.index') }}"></datagrid-plus>
            </div>
        </div>

    {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}
@endsection