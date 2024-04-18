@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.address.index.page-title') }}
@endsection

@section('page-detail-wrapper')
    <div class="d-md-flex py-2 justify-content-between">
        <div class="profile-content-title">
            {{ __('shop::app.customer.account.address.index.title') }}
        </div>

        @if (! $addresses->isEmpty())
            <span class="my-3 account-action mr-lg-3">
                <a href="{{ route('customer.address.create') }}" class="theme-btn rounded">
                    Add new address
                </a>
            </span>
        @endif
    </div>

    {!! view_render_event('bagisto.shop.customers.account.address.list.before', ['addresses' => $addresses]) !!}

    <div class="account-table-content">
        @if ($addresses->isEmpty())
            <a href="{{ route('customer.address.create') }}" class="theme-btn rounded address-button">
                Add new address </a>
            <p>
                {{ __('shop::app.customer.account.address.index.empty') }}
            </p>
        @else
            <div class="row address-holder mr-0">
                @foreach ($addresses as $address)
                    <div class="mt-lg-4 col-sm-12 col-md-6 col-xl-4">
                        <div class="card">
                            <h5 class="card-header fw6">{{ $address->first_name }} {{ $address->last_name }}</h5>
                            <div class="card-body">
                                <ul type="none">
                                    <li>{{ $address->address1 }}</li>
                                    <li>{{ $address->city }}</li>
                                    <li>{{ $address->state }}</li>
                                    <li>{{ core()->country_name($address->country) }} {{ $address->postcode }}</li>
                                    <li>
                                        {{ __('shop::app.customer.account.address.index.contact') }}
                                        : {{ $address->phone }}
                                    </li>
                                </ul>

                                <a class="card-link" href="{{ route('customer.address.edit', $address->id) }}">
                                    {{ __('shop::app.customer.account.address.index.edit') }}
                                </a>

                                <a class="card-link" href="javascript:void(0);"
                                   onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}', '{{ $address->id }}')">
                                    {{ __('shop::app.customer.account.address.index.delete') }}
                                </a>

                                <form id="deleteAddressForm{{ $address->id }}"
                                      action="{{ route('address.delete', $address->id) }}" method="post">
                                    @method('delete')

                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {!! view_render_event('bagisto.shop.customers.account.address.list.after', ['addresses' => $addresses]) !!}
@endsection

@push('scripts')
    <script>
        function deleteAddress(message, addressId) {
            if (!confirm(message)) {
                return;
            }

            $(`#deleteAddressForm${addressId}`).submit();
        }
    </script>
@endpush

@if ($addresses->isEmpty())
    <style>
        a#add-address-button {
            position: absolute;
            margin-top: 92px;
        }

        .address-button {
            position: absolute;
            z-index: 1 !important;
            margin-top: 5rem !important;
        }
    </style>
@endif
