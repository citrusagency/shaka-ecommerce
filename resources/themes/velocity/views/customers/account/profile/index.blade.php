@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection
@section('page-detail-wrapper')
    <div class="account-head mb-0">
        <div class="profile-content-title">
            {{ __('shop::app.customer.account.profile.index.title') }}
        </div>

        <span class="account-action border">
            <a href="{{ route('customer.profile.edit') }}" class="btn text-white unset float-right">
                Edit profile
            </a>
        </span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}

    <div class="account-table-content profile-page-content">
        <div class="table-striped col-lg-4 col-md-6 col-sm-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table">
                <tbody>
                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.before', ['customer' => $customer]) !!}

                    <tr class="row">
                        <td class="col-3">{{ __('shop::app.customer.account.profile.fname') }}</td>

                        <td class="col-5">{{ $customer->first_name }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.first_name.after', ['customer' => $customer]) !!}

                    <tr class="row">
                        <td class="col-3">{{ __('shop::app.customer.account.profile.lname') }}</td>

                        <td class="col-5">{{ $customer->last_name }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.last_name.after', ['customer' => $customer]) !!}

                    <tr class="row">
                        <td class="col-3">{{ __('shop::app.customer.account.profile.email') }}</td>

                        <td class="col-5">{{ $customer->email }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.after', ['customer' => $customer]) !!}
                </tbody>
            </table>
        </div>

@endsection