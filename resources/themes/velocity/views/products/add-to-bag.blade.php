{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}

<div class="row p-0">
        <div>
                @if($product->isSaleable())
                {{--            <div class="m-0 p-0">--}}
                {{--                <a style="display: flex !important; padding: 8px;">--}}
                {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
                {{--                        <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="#1197C2"/>--}}
                {{--                    </svg>--}}
                {{--                    <span class="kz-link">Add to bag</span>--}}
                {{--                </a>--}}
                {{--            </div>--}}
                    <add-to-bag
                        form="true"
                        csrf-token='{{ csrf_token() }}'
                        product-flat-id="{{ $product->id }}"
                        product-id="{{ $product->product_id }}"
                        reload-page="{{ $reloadPage ?? false }}"
                        move-to-cart="{{ $moveToCart ?? false }}"
                        wishlist-move-route="{{ $wishlistMoveRoute ?? false }}"
                        add-class-to-btn="{{ $addClassToBtn ?? '' }}"
                        is-enable={{ ! $product->isSaleable() ? 'false' : 'true' }}
                    show-cart-icon={{ ! (isset($showCartIcon) && ! $showCartIcon) }}
                    btn-text="{{ (! isset($moveToCart) && $product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}">
                    </add-to-bag>
                @else
                    <div class="m-0 p-0">
                        <a style="display: flex !important; padding: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.9 16.4 5.4 13.5 4.7V4C13.5 3.2 12.8 2.5 12 2.5C11.2 2.5 10.5 3.2 10.5 4V4.7C7.6 5.4 6 7.9 6 11V16L4 18V19H20V18L18 16ZM16 17H8V11C8 8.5 9.5 6.5 12 6.5C14.5 6.5 16 8.5 16 11V17Z" fill="#1197C2"/>
                            </svg>
                            <span class="kz-link">Notify me when available</span>
                        </a>
                    </div>
                @endif
        </div>
</div>


{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}