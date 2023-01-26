@php
    // If current route is /
    if (request()->route()->getName() == 'shop.home.index') {
        $headerClass = 'bg-transparent';
    } else {
        $headerClass = 'bg-shaka-dark';
    }
@endphp
<header class="sticky-header navbar-dark  text-white py-4 {{ $headerClass }}" style="height: auto!important;">
    <div class="container">


        <div class="row remove-padding-margin velocity-divide-page d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('shop.home.index') }}" aria-label="Logo">
                <img class="logo" src="{{ core()->getCurrentChannel()->logo_url ?? asset('images/shaka-white.png') }}" alt="" />
            </a>
            <div class="row gap-4">
                <a href="/" class="text-white text-uppercase  {{ request()->is('/') ? 'active-route' : '' }}">Homepage</a>
                <a href="{{ route('shop.getAllProducts') }}" class="text-white text-uppercase  {{ request()->is('shop') ? 'active-route' : '' }} ml-5">Shop</a>
                <a href="{{ route("shop.cms.page", 'about-us') }}" class="text-white text-uppercase  {{ request()->route()->slug? 'active-route' : '' }} ml-5">About the label</a>
                <a href="/" class="text-white text-uppercase  {{ request()->is('/behind-the-scenes') ? 'active-route' : '' }} ml-5">Behind the scenes</a>
                <a href="{{ route("shop.cms.page", 'contact-us') }}" class="text-white  text-uppercase {{ request()->is('/page/contact-us') ? 'active-route' : '' }} ml-5">Contact us</a>
            </div>


            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <!-- @include('velocity::shop.layouts.particals.search-bar') -->
                    </div>

                    <div class="col-lg-7 col-md-12 vc-full-screen">
                        <div class="left-wrapper d-flex align-items-center justify-content-center">


                            {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}

                            @include('velocity::shop.layouts.particals.wishlist', ['isText' => true])

                            {!! view_render_event('bagisto.shop.layout.header.wishlist.after') !!}

                            {!! view_render_event('bagisto.shop.layout.header.compare.before') !!}

                            <!-- @include('velocity::shop.layouts.particals.compare', ['isText' => true]) -->

                            {!! view_render_event('bagisto.shop.layout.header.compare.after') !!}

                            {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                            @include('shop::checkout.cart.mini-cart')

                            {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}
                            @include('velocity::layouts.top-nav.login-section')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50) {
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })();
    </script>
@endpush
