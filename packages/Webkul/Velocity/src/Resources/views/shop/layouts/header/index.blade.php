<header class="sticky-header navbar-dark bg-dark text-white py-3 " style="height: auto!important;">
    <div class="container">


        <div class="row remove-padding-margin velocity-divide-page d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('shop.home.index') }}" aria-label="Logo">
                <img class="logo" src="{{ core()->getCurrentChannel()->logo_url ?? asset('themes/velocity/assets/images/logo-text.png') }}" alt="" />
            </a>
            <div class="row gap-4">
                <a href="/" class="text-white">Homepage</a>
                <a href="/" class="text-white ml-4">Shop</a>
                <a href="{{ route("shop.cms.page", 'about-us') }}" class="text-white ml-4">About the label</a>
                <a href="/" class="text-white ml-4">Behind the scenes</a>
                <a href="{{ route("shop.cms.page", 'contact-us') }}" class="text-white ml-4">Contact us</a>
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
