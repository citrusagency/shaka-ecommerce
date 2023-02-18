<template>
    <div class="col-12 lg-card-container list-card product-card row" v-if="list">
        <div class="product-image">
            <a :title="product.name" :href="`${baseUrl}/${product.slug}`">
                <img
                    :src="product.image || product.product_image"
                    class="w-100 product-image"
                    :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`"/>

                <product-quick-view-btn :quick-view-details="product" v-if="!isMobile()"></product-quick-view-btn>
            </a>
        </div>

        <div class="product-information">
            <div>
                <div class="product-name">
                    <a :href="`${baseUrl}/${product.slug}`" :title="product.name" class="unset">
                        <span class="fs16">{{ product.name }}</span>
                    </a>
                </div>

                <div class="sticker new" v-if="product.new">
                    {{ product.new }}
                </div>

                <div class="product-price" v-html="product.priceHTML"></div>

                <div class="product-rating" v-if="product.totalReviews && product.totalReviews > 0">
                    <star-ratings :ratings="product.avgRating"></star-ratings>
                    <span>{{ __('products.reviews-count', {'totalReviews': product.totalReviews}) }}</span>
                </div>

                <div class="product-rating" v-else>
                    <span class="fs14" v-text="product.firstReviewText"></span>
                </div>

                <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>
            </div>
        </div>
    </div>
    <div class="product-container w-100" v-else>
        <a :href="`${baseUrl}/${product.slug}`" :title="product.name" class="product-image-container">
            <img
                loading="lazy"
                :alt="product.name"
                :src="product.image || product.product_image"
                :data-src="product.image || product.product_image"
                class="lzy_img w-100"
                :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`"/>
            <div class="sticker-new bg-shaka-primary px-4 py-1" v-if="product.special_price && product.isSaleable">
                sale
            </div>
            <div class="sticker-new px-4 py-1" style="background-color: #B84626!important;" v-if="!product.isSaleable">
                sold out
            </div>
            <div class="product-actions bg-shaka-darker py-2 px-3">
                    <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>
            </div>
        </a>
        <div class="product-name col-12 no-padding mt-2">
            <a
                class="unset"
                :title="product.name"
                :href="`${baseUrl}/${product.slug}`">
                <span class="fs16 font-weight-bold">{{ product.name }}</span>
                <br>
                <p v-html="product.priceHTML"></p>
<!--                <div class="product-price text-shaka-subtitle mt-2">{{ product.special_price ? product.special_price : product.price }}</div>-->
            </a>
        </div>
    </div>

    <!--    <div class="card grid-card product-card-new">-->
    <!--        <a :href="`${baseUrl}/${product.slug}`" :title="product.name" class="product-image-container">-->
    <!--            <img-->
    <!--                loading="lazy"-->
    <!--                :alt="product.name"-->
    <!--                :src="product.image || product.product_image"-->
    <!--                :data-src="product.image || product.product_image"-->
    <!--                class="card-img-top lzy_img w-100"-->
    <!--                :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`" />-->
    <!--                &lt;!&ndash; :src="`${$root.baseUrl}/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png`" /> &ndash;&gt;-->

    <!--            <product-quick-view-btn :quick-view-details="product"></product-quick-view-btn>-->
    <!--        </a>-->

    <!--        <div class="card-body">-->
    <!--            <div class="product-name col-12 no-padding">-->
    <!--                <a-->
    <!--                    class="unset"-->
    <!--                    :title="product.name"-->
    <!--                    :href="`${baseUrl}/${product.slug}`">-->

    <!--                    <span class="fs16">{{ product.name }}</span>-->
    <!--                </a>-->
    <!--            </div>-->

    <!--            <div class="sticker new" v-if="product.new">-->
    <!--                {{ product.new }}-->
    <!--            </div>-->

    <!--            <div v-html="product.priceHTML"></div>-->

    <!--            <div-->
    <!--                class="product-rating col-12 no-padding"-->
    <!--                v-if="product.totalReviews && product.totalReviews > 0">-->

    <!--                <star-ratings :ratings="product.avgRating"></star-ratings>-->
    <!--                <a class="fs14 align-top unset active-hover" :href="`${$root.baseUrl}/reviews/${product.slug}`">-->
    <!--                    {{ __('products.reviews-count', {'totalReviews': product.totalReviews}) }}-->
    <!--                </a>-->
    <!--            </div>-->

    <!--            <div class="product-rating col-12 no-padding" v-else>-->
    <!--                <span class="fs14" v-text="product.firstReviewText"></span>-->
    <!--            </div>-->

    <!--            <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>-->
    <!--        </div>-->
    <!--    </div>-->
</template>

<style lang="scss">
.product-image {
    aspect-ratio: 4/5;
    width: 100%;
    object-fit: cover;
}
</style>

<script type="text/javascript">
export default {
    props: [
        'list',
        'product',
    ],

    data: function () {
        return {
            'addToCart': 0,
            'addToCartHtml': '',
        }
    },

    methods: {
        'isMobile': function () {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
</script>