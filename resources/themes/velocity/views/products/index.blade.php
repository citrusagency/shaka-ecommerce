@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

@extends('shop::layouts.master')

@section('page_title')
    Shop
@stop

{{--@section('seo')--}}
{{--    <meta name="description" content="{{ $category->meta_description }}" />--}}
{{--    <meta name="keywords" content="{{ $category->meta_keywords }}" />--}}

{{--    @if (core()->getConfigData('catalog.rich_snippets.categories.enable'))--}}
{{--        <script type="application/ld+json">--}}
{{--            {!! app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category) !!}--}}
{{--        </script>--}}
{{--    @endif--}}
{{--@stop--}}

@php
    $isProductsDisplayMode = true;

    $isDescriptionDisplayMode = true;
@endphp

@section('content-wrapper')
    <category-component></category-component>
@stop

@push('scripts')

    <script type="text/x-template" id="category-template">
        <section class="container-fluidvelocity-divide-page category-page-wrapper pb-5">
            <div class="row" style="width:100%; margin:0;">
                <div class="col-3 div-hid">
                    @include ('shop::products.list.layered-navigation')
                </div>

                <div class="col-md-9 container right m-0" style="padding:0 10px; width: 100%;">
                    <div class="filters-container">
                        <template v-if="products.length >= 0">
                            @include ('shop::products.list.toolbar')
                        </template>
                    </div>
                    
                    <shimmer-component v-if="isLoading" shimmer-count="4"></shimmer-component>
                    
                    <template v-else-if="products.length > 0">
                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            <div class="shop-products-list">
                                <product-card
                                    class="col-6 col-md-4 col-lg-3 mt-5"
                                    :key="index"
                                    :product="product"
                                    v-for="(product, index) in products">
                                </product-card>
                            </div>
                        @else
                            <div class="product-list">
                                <product-card
                                    list=true
                                    :key="index"
                                    :product="product"
                                    v-for="(product, index) in products">
                                </product-card>
                            </div>
                        @endif
                        <div class="bottom-toolbar py-5" v-html="paginationHTML"></div>
                    </template>

                    <div class="product-list empty" v-else>
                        <h2>{{ __('shop::app.products.whoops') }}</h2>
                        <p>{{ __('shop::app.products.empty') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </script>

    <script>
        Vue.component('category-component', {
            template: '#category-template',

            data: function () {
                return {
                    'products': [],
                    'isLoading': true,
                    'paginationHTML': '',
                }
            },

            created: function () {
                this.getCategoryProducts();
            },

            methods: {
                'getCategoryProducts': function () {
                    this.$http.get(`${this.$root.baseUrl}/all-products${window.location.search}`)
                        .then(response => {
                            this.isLoading = false;
                            this.products = response.data.products;
                            this.paginationHTML = response.data.paginationHTML;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.log(this.__('error.something_went_wrong'));
                        })
                }
            }
        })
    </script>
@endpush
