{!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}

<div class="product-price mt-2">
    {!! $product->getTypeInstance()->getPriceHtml() !!}
</div>

{!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}