@foreach ($cart->items as $item)
    <?php
        $product = $item->product;

        if ($product->cross_sells()->count()) {
            $products[] = $product;
            $products = array_unique($products);
        }
    ?>
@endforeach

<?php
    $crossSellProducts = [];

    foreach ($products as $product) {
        foreach ($product->cross_sells()->paginate(10) as $crossSellProduct) {
            $isUnique = true;

            foreach ($cart->items as $item) {
                if ($item->product->id === $crossSellProduct->id) {
                    $isUnique = false;
                    break;
                }
            }

            if ($isUnique) {
                $crossSellProducts[$crossSellProduct->id] = $crossSellProduct;
            }
        }
    }
    $uniqueCrossSellProducts = array_values($crossSellProducts);
?>

@if (isset($products))

    <card-list-header
        heading="{{ __('shop::app.products.cross-sell-title') }}"
        view-all="false"
        row-class="pt20"
        class="vc-full-screen w-100"
    ></card-list-header>

    <div class="m-auto">
        <div class="vc-full-screen d-flex flex-wrap" >
            @foreach ($uniqueCrossSellProducts as $index => $crossSellProduct)
                    @include ('shop::products.list.card', [
                        'product' => $crossSellProduct,
                        'addToCartBtnClass' => 'small-padding',
                    ])
            @endforeach
        </div>
    </div>

@endif