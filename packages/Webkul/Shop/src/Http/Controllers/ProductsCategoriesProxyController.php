<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Core\Repositories\SliderRepository;
use Webkul\Product\Facades\ProductImage;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Category\Repositories\CategoryRepository;

class ProductsCategoriesProxyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @return void
     */
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository,
        protected SliderRepository $sliderRepository
    )
    {
        parent::__construct();
    }


    public function formatProduct($product, $list = false, $metaInformation = [])
    {
        $reviewHelper = app('Webkul\Product\Helpers\Review');

        $galleryImages = ProductImage::getGalleryImages($product);
        $productImage = ProductImage::getProductBaseImage($product, $galleryImages)['medium_image_url'];

        $largeProductImageName = 'large-product-placeholder.png';
        $mediumProductImageName = 'medium-product-placeholder.png';

        if (strpos($productImage, $mediumProductImageName) > -1) {
            $productImageNameCollection = explode('/', $productImage);
            $productImageName = $productImageNameCollection[sizeof($productImageNameCollection) - 1];

            if ($productImageName == $mediumProductImageName) {
                $productImage = str_replace($mediumProductImageName, $largeProductImageName, $productImage);
            }
        }

        $priceHTML = view('shop::products.price', ['product' => $product])->render();

        $isProductNew = ($product->new && strpos($priceHTML, 'sticker sale') === false) ? __('shop::app.products.new') : false;

        return [
            'priceHTML'        => $priceHTML,
            'isSaleable' => $product->isSaleable(),
            'price'            => core()->currency($product->price),
            'special_price'            => $product->special_price ? core()->currency($product->special_price) : null,
            'avgRating'        => ceil($reviewHelper->getAverageRating($product)),
            'totalReviews'     => $reviewHelper->getTotalReviews($product),
            'image'            => $productImage,
            'new'              => $isProductNew,
            'galleryImages'    => $galleryImages,
            'name'             => $product->name,
            'slug'             => $product->url_key,
            'description'      => $product->description,
            'shortDescription' => $product->short_description,
            'firstReviewText'  => trans('velocity::app.products.be-first-review'),
            'addToCartHtml'    => view('shop::products.add-to-cart', [
                'product'          => $product,
                'addWishlistClass' => ! (isset($list) && $list) ? '' : '',

                'showCompare' => false,

                'btnText' => (isset($metaInformation['btnText']) && $metaInformation['btnText'])
                    ? $metaInformation['btnText'] : null,

                'moveToCart' => (isset($metaInformation['moveToCart']) && $metaInformation['moveToCart'])
                    ? $metaInformation['moveToCart'] : null,

                'addToCartBtnClass' => ! (isset($list) && $list) ? 'small-padding' : '',
            ])->render(),
        ];
    }

    /**
     * Show product or category view. If neither category nor product matches, abort with code 404.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Exception
     */
    public function index(Request $request)
    {
        $slugOrPath = trim($request->getPathInfo(), '/');

        $slugOrPath = urldecode($slugOrPath);

        // support url for chinese, japanese, arbic and english with numbers.
        if (preg_match('/^([\x{0621}-\x{064A}\x{4e00}-\x{9fa5}\x{3402}-\x{FA6D}\x{3041}-\x{30A0}\x{30A0}-\x{31FF}_a-z0-9-]+\/?)+$/u', $slugOrPath)) {
            if ($category = $this->categoryRepository->findByPath($slugOrPath)) {
                return view($this->_config['category_view'], compact('category'));
            }

            if ($product = $this->productRepository->findBySlug($slugOrPath)) {
                $customer = auth()->guard('customer')->user();
                $relatedProducts = $product->related_products()->get()->map(function ($relatedProduct) {
                    return $this->formatProduct($relatedProduct);
                });

                return view($this->_config['product_view'], compact('product', 'customer', 'relatedProducts'));
            }

            abort(404);
        }

        $sliderData = $this->sliderRepository->getActiveSliders();

        return view('shop::home.index', compact('sliderData'));
    }
}
