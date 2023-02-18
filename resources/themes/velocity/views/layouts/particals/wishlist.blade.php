@php
    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
@endphp

@if($showWishlist)

    <wishlist-component-with-badge
        is-customer="{{ auth()->guard('customer')->check() ? 'true' : 'false' }}"
        imgSrc="{{asset('images/wishlist.svg')}}asdad"
        is-text="{{ isset($isText) && $isText ? 'true' : 'false' }}"
        src="{{ route('customer.wishlist.index') }}">
    </wishlist-component-with-badge>

@endif