@php
    $count = core()->getConfigData('catalog.products.homepage.no_of_new_product_homepage');
    $count = $count ? $count : 10;
    $direction = core()->getCurrentLocale()->direction == 'rtl' ? 'rtl' : 'ltr';
@endphp

{!! view_render_event('bagisto.shop.new-products.before') !!}
<div class="bg-white py-5">
    <div class="container">
        <h2 class="text-center text-white text-shaka-black  heading-2 h1 mt-5 mb-2">
            The new arrivals
        </h2>
        <br>
        <p class="text-center text-shaka-subtitle">
            Comfortable and sustainable styles for your sustainable living.
        </p>
    </div>
</div>
<product-collections
    count="{{ (int) $count }}"
    product-id="new-products-carousel"
    product-title="{{ __('shop::app.home.new-products') }}"
    product-route="{{ route('velocity.category.details', ['category-slug' => 'new-products', 'count' => $count]) }}"
    locale-direction="{{ $direction }}"
    show-recently-viewed="{{ (Boolean) 'false' }}"
    recently-viewed-title="{{ __('velocity::app.products.recently-viewed') }}"
    no-data-text="{{ __('velocity::app.products.not-available') }}">
</product-collections>

{!! view_render_event('bagisto.shop.new-products.after') !!}
