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
        <div class="col-6">
            <div class="hamburger-wrapper">
                <i class="rango-toggle hamburger"></i>
            </div>

            <a class="left" href="{{ route('shop.home.index') }}" aria-label="Logo">
                {!! file_get_contents(public_path('/images/logo.svg')) !!}
            </a>
        </div>

        <div class="right-vc-header col-6">
            <a class="unset cursor-pointer">
                <i class="material-icons">search</i>
            </a>
            <a href="{{ route('shop.checkout.cart.index') }}" class="unset">
                <i class="material-icons text-down-3">shopping_cart</i>
                <div class="badge-wrapper">
                    <span class="badge">{{ $cartItemsCount }}</span>
                </div>
            </a>
        </div>
    </div>

    <template v-slot:greetings>
        @guest('customer')
            <a class="unset" href="{{ route('customer.session.index') }}">
                {{ __('velocity::app.responsive.header.greeting', ['customer' => 'Guest']) }}
            </a>
        @endguest

        @auth('customer')
            <a class="unset" href="{{ route('customer.profile.index') }}">
                {{ __('velocity::app.responsive.header.greeting', ['customer' => auth()->guard('customer')->user()->first_name]) }}
            </a>
        @endauth
    </template>

    <template v-slot:customer-navigation>

        <ul class="vc-customer-options">
            <li>
                <a
                    class="unset fw5  {{ request()->is('/') ? 'fw7' : '' }}"
                    href="/">
                    <span class="text-shaka-black text-uppercase fs18" >Home</span>
                </a>
            </li>
            <li>
                <a
                    class="unset fw5 {{ request()->is('shop') ? 'fw7' : '' }}"
                    href="{{ route('shop.getAllProducts') }}">
                    <span class="text-shaka-black text-uppercase fs18">Shop</span>
                </a>
            </li>
            <li>
                <a
                    class="unset fw5 {{ request()->is('about') ? 'fw7' : '' }}"
                    href="{{ route("shop.about") }}">
                    <span class="text-shaka-black text-uppercase fs18">About</span>
                </a>
            </li>
            <!-- <li>
                <a
                    class="unset fw5 {{ request()->is('behind-the-scenes') ? 'fw7' : '' }}"
                    href="{{ route("shop.behind-the-scenes") }}">
                    <span class="text-shaka-black text-uppercase fs18">Behind the scenes</span>
                </a>
            </li> -->
            <li>
                <a
                    class="unset fw5 {{ request()->is('contact') ? 'fw7' : '' }}"
                    href="{{ route("shop.contact.index") }}">
                    <span class="text-shaka-black text-uppercase fs18">Contact</span>
                </a>
            </li>

        </ul>

        @auth('customer')
            <ul type="none" class="vc-customer-options">
                <li>
                    <a href="{{ route('customer.profile.index') }}" class="unset">
                        <i class="icon profile text-down-3"></i>
                        <span>{{ __('shop::app.header.profile') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customer.address.index') }}" class="unset">
                        <i class="icon address text-down-3"></i>
                        <span>{{ __('velocity::app.shop.general.addresses') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customer.reviews.index') }}" class="unset">
                        <i class="icon reviews text-down-3"></i>
                        <span>{{ __('velocity::app.shop.general.reviews') }}</span>
                    </a>
                </li>

                @if (core()->getConfigData('general.content.shop.wishlist_option'))
                    <li>
                        <a href="{{ route('customer.wishlist.index') }}" class="unset">
                            <i class="icon wishlist text-down-3"></i>
                            <span>{{ __('shop::app.header.wishlist') }}</span>
                        </a>
                    </li>
                @endif

{{--                @if (core()->getConfigData('general.content.shop.compare_option'))--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('velocity.customer.product.compare') }}" class="unset">--}}
{{--                            <i class="icon compare text-down-3"></i>--}}
{{--                            <span>{{ __('shop::app.customer.compare.text') }}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endif--}}

                <li>
                    <a href="{{ route('customer.orders.index') }}" class="unset">
                        <i class="icon orders text-down-3"></i>
                        <span>{{ __('velocity::app.shop.general.orders') }}</span>
                    </a>
                </li>

{{--                <li>--}}
{{--                    <a href="{{ route('customer.downloadable_products.index') }}" class="unset">--}}
{{--                        <i class="icon downloadables text-down-3"></i>--}}
{{--                        <span>{{ __('velocity::app.shop.general.downloadables') }}</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
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

                <a
                    class="unset fw7"
                    href="{{ route('customer.session.destroy') }}"
                    onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                    {{ __('shop::app.header.logout') }}
                </a>
            @endauth

            @guest('customer')
                <a
                    class="unset fw7 "
                    href="{{ route('customer.session.create') }}">
                    <span class="text-shaka text-uppercase fs18">{{ __('shop::app.customer.login-form.title') }}</span>
                </a>
            @endguest
        </li>

        <li>
            @guest('customer')
                <a
                    class="unset fw7 "
                    href="{{ route('customer.register.index') }}">
                    <span class="text-shaka text-uppercase fs18">Create an account</span>
                </a>
            @endguest
        </li>
    </template>

    <template v-slot:logo>
        <a class="left ml-5" href="{{ route('shop.home.index') }}" aria-label="Logo">
            {!! file_get_contents(public_path('/images/logo.svg')) !!}
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

    <template v-slot:search-bar>
        <div class="row">
            <div class="col-md-12">
                @include('velocity::shop.layouts.particals.search-bar')
            </div>
        </div>
    </template>

</mobile-header>