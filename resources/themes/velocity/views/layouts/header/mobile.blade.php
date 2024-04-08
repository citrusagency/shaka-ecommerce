@php
    $cart = cart()->getCart();
    $cartItemsCount = $cart ? $cart->items->count() : trans('shop::app.minicart.zero');
@endphp

<mobile-header
    class="py-2"
    is-customer="{{ auth()->guard('customer')->check() ? 'true' : 'false' }}"
    heading= "{{ __('velocity::app.menu-navbar.text-category') }}"
    :header-content="{{ json_encode(app('Webkul\Velocity\Repositories\ContentRepository')->getAllContents()) }}"
    category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
    cart-items-count="{{ $cartItemsCount }}"
    cart-route="{{ route('shop.checkout.cart.index') }}"
    :locale="{{ json_encode(core()->getCurrentLocale()) }}"
    :all-locales="{{ json_encode(core()->getCurrentChannel()->locales()->orderBy('name')->get()) }}"
    :currency="{{ json_encode(core()->getCurrentCurrency()) }}"
    :all-currencies="{{ json_encode(core()->getCurrentChannel()->currencies) }}"
>

    {{-- this is default content if js is not loaded --}}
    <div class="row">
        <div class="col-1" style="padding: 20px 10px;">
            <div class="hamburger-wrapper">
                <i class="rango-toggle hamburger"></i>
            </div>
        </div>
        <div class="col-2" style="padding:10px 20px;">
            <a class="left" href="{{ route('shop.home.index') }}" aria-label="Logo" >
                {!! file_get_contents(public_path('/images/logo_mobile_white.svg')) !!}
            </a>
        </div>
    </div>

    <template v-slot:customer-navigation>
        <ul class="vc-customer-options">
            <li>
                <a
                    class="unset fw5  {{ request()->is('/') ? 'fw7' : '' }}"
                    href="/">
                    <span style="font-family: Outfit, sans-serif;" class="text-uppercase fs18" >Homepage</span>
                </a>
            </li>
            <li>
                <a
                    class="unset fw5 {{ request()->is('shop') ? 'fw7' : '' }}"
                    href="{{ route('shop.getAllProducts') }}">
                    <span style="font-family: Outfit, sans-serif;" class="text-uppercase fs18">Shop</span>
                </a>
            </li>
            <li>
                <a
                    class="unset fw5 {{ request()->is('about') ? 'fw7' : '' }}"
                    href="{{ route("shop.about") }}">
                    <span style="font-family: Outfit, sans-serif;" class="text-uppercase fs18">About</span>
                </a>
            </li>
            <li>
                <a
                    class="unset fw5 {{ request()->is('contact') ? 'fw7' : '' }}"
                    href="{{ route("shop.contact.index") }}">
                    <span style="font-family: Outfit, sans-serif;"  class="text-shaka-black text-uppercase fs18">Contact</span>
                </a>
            </li>
        </ul>

        @auth('customer')
            <ul type="none" class="vc-customer-options">
                <li>
                    <a href="{{ route('customer.profile.index') }}" class="unset" style="display:flex; align-items: center; gap:10px;">
                        {!! file_get_contents(public_path('/images/profile_icon.svg')) !!}
                        <span>{{ __('shop::app.header.profile') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customer.address.index') }}" class="unset" style="display:flex; align-items: center; gap:10px;">
                        {!! file_get_contents(public_path('/images/address_icon.svg')) !!}
                        <span>{{ __('velocity::app.shop.general.addresses') }}</span>
                    </a>
                </li>


                @if (core()->getConfigData('general.content.shop.wishlist_option'))
                    <li>
                        <a href="{{ route('customer.wishlist.index') }}" class="unset" style="display:flex; align-items: center; gap:10px;">
                            {!! file_get_contents(public_path('/images/wishlist_icon.svg')) !!}
                            <span>{{ __('shop::app.header.wishlist') }}</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('customer.orders.index') }}" class="unset" style="display:flex; align-items: center; gap:10px;">
                        {!! file_get_contents(public_path('/images/order_icon.svg')) !!}
                        <span>{{ __('velocity::app.shop.general.orders') }}</span>
                    </a>
                </li>

            </ul>
        @endauth
    </template>


    <template v-slot:extra-navigation>
        <li>
            @auth('customer')
                <form id="customerLogout" action="{{ route('customer.session.destroy') }}" method="POST">
                    @csrf

                    @method('DELETE')
                </form>

                <a style="color:#1197C2;
                font-size: 18px !important;
                font-family: Outfit, sans-serif;
                font-weight: 600 !important;
                text-transform: uppercase !important;"
                    class="customer-links"
                    href="{{ route('customer.session.destroy') }}"
                    onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                    {{ __('shop::app.header.logout') }}
                </a>
            @endauth

            @guest('customer')
                <a style="color:#1197C2;
                font-size: 18px !important;
                font-family: Outfit, sans-serif;
                font-weight: 600 !important;
                text-transform: uppercase !important;"
                    class="customer-links"
                    href="{{ route('customer.session.create') }}">
                    <span class="text-shaka text-uppercase fs18">{{ __('shop::app.customer.login-form.title') }}</span>
                </a>
            @endguest
        </li>

        <li>
            @guest('customer')
                <a style="color:#1197C2;
                font-size: 18px !important;
                font-weight: 600 !important;
                font-family: Outfit, sans-serif;
                text-transform: uppercase !important;"
                    class="customer-links"
                    href="{{ route('customer.register.index') }}">
                    <span class="text-shaka text-uppercase fs18">Create an account</span>
                </a>
            @endguest
        </li>

    </template>


    <template v-slot:logo>
        <a class="left ml-5" href="{{ route('shop.home.index') }}" aria-label="Logo">
            {!! file_get_contents(public_path('/images/logo_mobile_white.svg')) !!}
        </a>
    </template>

    <template v-slot:top-header>
            <div class="" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center; gap: 20px">
                <a href="{{  route('shop.checkout.cart.index') }}" class="mini-cart-btna m-0" >
                    <mini-cart
                        is-tax-inclusive="{{ Webkul\Tax\Helpers\Tax::isTaxInclusive() }}"
                        view-cart-route="{{ route('shop.checkout.cart.index') }}"
                        checkout-route="{{ route('shop.checkout.onepage.index') }}"
                        check-minimum-order-route="{{ route('shop.checkout.check-minimum-order') }}"
                        cart-text="{{ __('shop::app.minicart.cart') }}"
                        view-cart-text="{{ __('shop::app.minicart.view-cart') }}"
                        checkout-text="{{ __('shop::app.minicart.checkout') }}"
                        subtotal-text="{{ __('shop::app.checkout.cart.cart-subtotal') }}">
                    </mini-cart>
                </a>
                @include('shop::layouts.particals.wishlist', ['isText' => true])

            </div>
    </template>

</mobile-header>