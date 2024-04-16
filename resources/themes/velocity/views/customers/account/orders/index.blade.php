@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.order.index.page-title') }}
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