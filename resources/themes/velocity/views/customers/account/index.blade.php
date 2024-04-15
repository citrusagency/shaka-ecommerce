@extends('shop::layouts.master')

@section('content-wrapper')
    <div class="profile-index" >
        <div class="sidebar left sidebar_menu" >
            @include('shop::customers.account.partials.sidemenu')
        </div>

        <div class="profile-content">
            @yield('page-detail-wrapper')
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
@endpush