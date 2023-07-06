{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}

<div class="row">
    <div class="col-8">
        <div class="add-to-cart-btn pl0">
            @if (
                isset($form)
                && ! $form
            )
                @if($product->isSaleable())
                    <button
                        type="submit"
                        {{ ! $product->isSaleable() ? 'disabled' : '' }}
                        class="theme-btn {{ $addToCartBtnClass ?? '' }}">

                        @if (
                            ! (isset($showCartIcon)
                            && ! $showCartIcon)
                        )
                            {{--                        <i class="material-icons text-down-3">shopping_cart</i>--}}
                        @endif

                        {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') :  __('shop::app.products.add-to-cart') }}
                    </button>
                @else
                    <button>marko</button>
                @endif
            @elseif(isset($addToCartForm) && ! $addToCartForm)
                <form
                    method="POST"
                    action="{{ route('cart.add', $product->product_id) }}">

                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="quantity" value="1">
                    @if($product->isSaleable())
                        <button
                            type="submit"
                            {{ ! $product->isSaleable() ? 'disabled' : '' }}
                            class="btn btn-add-to-cart {{ $addToCartBtnClass ?? '' }}">

                            @if (
                                ! (isset($showCartIcon)
                                && ! $showCartIcon)
                            )
                                {{--                            <i class="material-icons text-down-3">shopping_cart</i>--}}
                            @endif

                            <span class="fs14 fw6 text-uppercase text-up-4">
                            {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}
                        </span>
                        </button>
                    @else
                        <button>Let me know when available</button>
                    @endif
                </form>
            @else
                @if($product->isSaleable())
                    <add-to-cart
                        form="true"
                        csrf-token='{{ csrf_token() }}'
                        product-flat-id="{{ $product->id }}"
                        product-id="{{ $product->product_id }}"
                        reload-page="{{ $reloadPage ?? false }}"
                        move-to-cart="{{ $moveToCart ?? false }}"
                        wishlist-move-route="{{ $wishlistMoveRoute ?? false }}"
                        add-class-to-btn="{{ $addToCartBtnClass ?? '' }}"
                        is-enable={{ ! $product->isSaleable() ? 'false' : 'true' }}
                    show-cart-icon={{ ! (isset($showCartIcon) && ! $showCartIcon) }}
                    btn-text="{{ (! isset($moveToCart) && $product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}">
                    </add-to-cart>
                @else
                    <button class="btn btn-add-to-cart available text-uppercase font-shaka-open-sans" style="font-size: 12px;
                    background-color: transparent!important;
                    border: none!important;
                    text-align: left;
                    font-weight: 700;
                    /*text-decoration: underline;*/
                    ">let me know when available</button>
                @endif
            @endif
        </div>
    </div>
    <div class="col-4 p-0 pr-2">

        @include('shop::products.wishlist', [
            'addClass' => $addWishlistClass ?? ''
        ])

    </div>
</div>


{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}