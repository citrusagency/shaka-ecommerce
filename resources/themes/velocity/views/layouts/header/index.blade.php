@php
    $headerClass = (request()->is('/') || request()->is('about') || (isset($exception) && $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)) ? 'bg-transparent' : 'bg-shaka-black2';
@endphp
<header class="sticky-header navbar-dark text-white py-4 {{ $headerClass }}" style="height: auto!important;">
    <div class="container" style="letter-spacing:2px;">


        <div class="row remove-padding-margin velocity-divide-page d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('shop.home.index') }}" aria-label="Logo">
                {!! file_get_contents(public_path('/images/logo.svg')) !!}
            </a>
            <div class="row gap-4">
                <a href="/" class="text-white header-a {{ request()->is('/') ? 'active-route' : '' }}">Home</a>
                <a href="{{ route('shop.getAllProducts') }}" class="text-white header-a {{ request()->is('shop') ? 'active-route' : '' }} ml-5">Shop</a>
                <a href="{{ route("shop.about") }}" class="text-white header-a {{ request()->is('about') ? 'active-route' : '' }} ml-5">About</a>
                <a href="{{ route("shop.contact.index") }}" class="text-white header-a {{ request()->is('contact') ? 'active-route' : '' }} ml-5">Contact</a>
            </div>


            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <!-- @include('velocity::shop.layouts.particals.search-bar') -->
                    </div>

                    <div class="col-lg-7 col-md-12 vc-full-screen">
                        <div class="left-wrapper d-flex align-items-center justify-content-center">

                            {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                            @include('shop::checkout.cart.mini-cart')

                            {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}

                            {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}

                            @include('shop::layouts.particals.wishlist', ['isText' => true])

                            {!! view_render_event('bagisto.shop.layout.header.wishlist.after') !!}

                            {!! view_render_event('bagisto.shop.layout.header.compare.before') !!}

                            <!-- @include('velocity::shop.layouts.particals.compare', ['isText' => true]) -->

                            {!! view_render_event('bagisto.shop.layout.header.compare.after') !!}


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
