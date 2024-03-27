@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

@extends('shop::layouts.master')

@section('page_title')
    Shop
{{--        {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}--}}
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

@push('css')
    <style type="text/css">
        .product-price span:first-child, .product-price span:last-child {
            font-size: 18px;
            font-weight: 600;
        }

        @media only screen and (max-width: 992px) {
            .main-content-wrapper .vc-header {
                box-shadow: unset;
            }
        }
    </style>
@endpush


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
                {{--            {!! view_render_event('bagisto.shop.productOrCategory.index.before', ['category' => $category]) !!}--}}

                {{--            @if (true)--}}
                <div class="col-4">
                    @include ('shop::products.list.layered-navigation')
                </div>
                {{--            @endif--}}

                <div class="col-12 col-md-8 container right" style="padding:0 10px; width: 100%;">
                    <div class="row remove-padding-margin">
                        <div class="pl0 col-12">
                            {{--                        <h2 class="fw6 mb10">{{ $category->name }}</h2>--}}

                            @if ($isDescriptionDisplayMode)
                                {{--                            @if ($category->description)--}}
                                {{--                                <div class="category-description">--}}
                                {{--                                    {!! $category->description !!}--}}
                                {{--                                </div>--}}
                                {{--                            @endif--}}
                            @endif
                        </div>

                        <div class="col-12 no-padding">
                            <div class="hero-image">
                                {{--                            @if (!is_null($category->image))--}}
                                {{--                                <img class="logo" src="{{ $category->image_url }}" alt="" width="20" height="20" />--}}
                                {{--                            @endif--}}
                            </div>
                        </div>
                    </div>


                    <div class="filters-container">
                        <template v-if="products.length >= 0">
                            @include ('shop::products.list.toolbar')
                        </template>
                    </div>

                    <div
                        class="category-block"
                    {{--                        @if ($category->display_mode == 'description_only')--}}
                    {{--                            style="width: 100%"--}}
                    {{--                        @endif>--}}

                    <shimmer-component v-if="isLoading" shimmer-count="4"></shimmer-component>

                    <template v-else-if="products.length > 0">
                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            <div class="row  remove-padding-margin pb-5">
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

                        {{--                            {!! view_render_event('bagisto.shop.productOrCategory.index.pagination.before', ['category' => $category]) !!}--}}

                        <div class="bottom-toolbar py-5" v-html="paginationHTML"></div>

                        {{--                            {!! view_render_event('bagisto.shop.productOrCategory.index.pagination.after', ['category' => $category]) !!}--}}
                    </template>

                    <div class="product-list empty" v-else>
                        <h2>{{ __('shop::app.products.whoops') }}</h2>
                        <p>{{ __('shop::app.products.empty') }}</p>
                    </div>
                </div>

            </div>
            </div>
            {{--            {!! view_render_event('bagisto.shop.productOrCategory.index.after', ['category' => $category]) !!}--}}
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