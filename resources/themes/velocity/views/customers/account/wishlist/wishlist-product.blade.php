<div class="lg-card-container product-card" >
    <div class="product-image" style=" position: relative !important;">
        @php
            $image = $item->product->getTypeInstance()->getBaseImage($item);
        @endphp

        <a
            title="{{ $item->product->name }}"
            href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}">
            <img
                src="{{ $image['medium_image_url'] }}"
                :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`" alt="" />
                {{--            <div class="quick-view-in-list">--}}
                {{--            </div>--}}
        </a>
        <div class="remove-icon" style="position: absolute !important;bottom:0; right:0; margin:10px;">
            <form id="wishlist-{{ $item->id }}" action="{{ route('customer.wishlist.remove', $item->id) }}" method="POST">
                @method('DELETE')
                <button class="rango-delete fs24 remove-btn"></button>
                @csrf
            </form>
        </div>
    </div>

    <div class="product-information">
        <div class="p-2">
            <div class="m-0 p-0">
                <a
                    href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}"
                    title="{{ $item->product->name }}" class="unset">

                    <span class="wishcard-title">{{ $item->product->name }}</span>


                    @if (isset($item->additional['attributes']))
                        <div class="item-options">
                            @foreach ($item->additional['attributes'] as $attribute)
                                <b>{{ $attribute['attribute_name'] }} : </b> {{ $attribute['option_label'] }}
                                </br>
                            @endforeach
                        </div>
                    @endif
                </a>

                @if (isset($item->product->additional['attributes']))
                    <div class="item-options">
                        @foreach ($item->product->additional['attributes'] as $attribute)
                            <b>{{ $attribute['attribute_name'] }} : </b> {{ $attribute['option_label'] }}
                            </br>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="m-0 p-0">
                @include ('shop::products.price', ['product' => $item->product])
            </div>

            <div class="m-0 p-0">
                @include('shop::products.add-to-bag', [
                    'reloadPage'        => true,
                    'product'           => $item->product,
                    'addClassToBtn'     => 'kz-link',
                    'showCompare'       => false,
                ])
            </div>
        </div>
    </div>
</div>