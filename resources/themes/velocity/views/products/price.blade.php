{!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}

<div class="product-price-kz">
    {!! $product->getTypeInstance()->getPriceHtml() !!}
</div>

{!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}