<?php

use Illuminate\Support\Facades\Route;
use Webkul\CMS\Http\Controllers\Shop\PagePresenterController;
use Webkul\Shop\Http\Controllers\HomeController;
use Webkul\Shop\Http\Controllers\ProductController;
use Webkul\Shop\Http\Controllers\CategoryController;
use Webkul\Shop\Http\Controllers\ReviewController;
use Webkul\Shop\Http\Controllers\SearchController;
use Webkul\Shop\Http\Controllers\SubscriptionController;

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    /**
     * Cart merger middleware. This middleware will take care of the items
     * which are deactivated at the time of buy now functionality. If somehow
     * user redirects without completing the checkout then this will merge
     * full cart.
     *
     * If some routes are not able to merge the cart, then place the route in this
     * group.
     */
    Route::group(['middleware' => ['cart.merger']], function () {
        /**
         * CMS pages.
         */
        Route::get('page/{slug}', [PagePresenterController::class, 'presenter'])->name('shop.cms.page');
        Route::get('about', function (){
            return view('shop::about');
        })->name('shop.about');
        Route::get('behind-the-scenes', function (){
            return view('shop::behind-the-scenes');
        })->name('shop.behind-the-scenes');

        Route::get('privacy-policy', function (){
            $pp = \Webkul\CMS\Models\CmsPageTranslation::where('url_key', 'privacy-policy')->first();
            return view('shop::privacy-policy', compact('pp'));
        })->name('shop.privacy-policy');
        Route::get('returns', function (){
            $r = \Webkul\CMS\Models\CmsPageTranslation::where('url_key', 'return-policy')->first();
            return view('shop::returns', compact('r'));
        })->name('shop.returns');
        Route::get('terms-conditions', function (){
            $tc = \Webkul\CMS\Models\CmsPageTranslation::where('url_key', 'terms-conditions')->first();
            return view('shop::terms-conditions', compact('tc'));
        })->name('shop.terms-conditions');

        /**
         * Fallback route.
         */
        Route::fallback(\Webkul\Shop\Http\Controllers\ProductsCategoriesProxyController::class . '@index')
            ->defaults('_config', [
                'product_view'  => 'shop::products.view',
                'category_view' => 'shop::products.index',
            ])
            ->name('shop.productOrCategory.index');
    });

    Route::get('/shop', [ProductController::class, 'getAll'])->name('shop.getAllProducts');
    Route::get('/giftcard', [ProductController::class, 'getGiftCardView'])->name('shop.giftCard');
    Route::post('/giftcard', [ProductController::class, 'sendGiftCard'])->name('shop.sendGiftCard');

    /**
     * Store front home.
     */
    Route::get('/', [HomeController::class, 'index'])->defaults('_config', [
        'view' => 'shop::home.index',
    ])->name('shop.home.index');

    /**
     * Store front search.
     */
    Route::get('/search', [SearchController::class, 'index'])->defaults('_config', [
        'view' => 'shop::search.search',
    ])->name('shop.search.index');

    Route::post('/upload-search-image', [HomeController::class, 'upload'])->name('shop.image.search.upload');

    /**
     * Subscription routes.
     */
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('shop.subscribe');

    Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe'])->name('shop.unsubscribe');

    /**
     * Product and categories routes.
     */
    Route::get('/reviews/{slug}', [ReviewController::class, 'show'])->defaults('_config', [
        'view' => 'shop::products.reviews.index',
    ])->name('shop.reviews.index');

    Route::get('/product/{slug}/review', [ReviewController::class, 'create'])->defaults('_config', [
        'view' => 'shop::products.reviews.create',
    ])->name('shop.reviews.create');

    Route::post('/product/{slug}/review', [ReviewController::class, 'store'])->defaults('_config', [
        'redirect' => 'shop.home.index',
    ])->name('shop.reviews.store');

    Route::get('/downloadable/download-sample/{type}/{id}', [ProductController::class, 'downloadSample'])->name('shop.downloadable.download_sample');

    Route::get('/product/{id}/{attribute_id}', [ProductController::class, 'download'])->defaults('_config', [
        'view' => 'shop.products.index',
    ])->name('shop.product.file.download');

//    Route::get('categories/filterable-attributes/{categoryId?}', [CategoryController::class, 'getFilterAttributes'])->name('catalog.categories.filterable-attributes');
    Route::get('categories/filterable-attributes', [CategoryController::class, 'getFilterAttributes'])->name('catalog.categories.filterable-attributes');

    Route::get('categories/maximum-price', [CategoryController::class, 'getCategoryProductMaximumPrice'])->name('catalog.categories.maximum-price');
//    Route::get('categories/maximum-price/{categoryId?}', [CategoryController::class, 'getCategoryProductMaximumPrice'])->name('catalog.categories.maximum-price');
});
