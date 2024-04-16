@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.order.index.page-title') }}
@endsection
@section('head')
    <style>
        .control-group .control {
            background: #ffffff;
            border: 2px solid #C7C7C7;
            border-radius: 3px;
            width: 70%;
            height: 36px;
            display: inline-block;
            vertical-align: middle;
            transition: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0px 10px;
            font-size: 15px;
            margin-top: 10px;
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('page-detail-wrapper')

    <div class="profile-content-title">
        {{ __('shop::app.customer.account.order.index.title') }}
    </div>

    {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

    <div class="account-items-list">

        <div class="account-table-content">
            <div class="table">
                <div class="grid-container">

                    <datagrid-plus src="{{ route('customer.orders.index') }}"></datagrid-plus>

                </div>
            </div>
        </div>
    </div>



    {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}
@endsection
@push('scripts')
    @include('admin::export.export', ['gridName' => app('Webkul\Admin\DataGrids\OrderDataGrid')])
@endpush