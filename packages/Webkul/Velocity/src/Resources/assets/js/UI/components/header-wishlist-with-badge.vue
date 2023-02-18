<template>
    <a class="wishlist-btn unset cart-container mr-4" :href="src">
<!--        <i class="material-icons">favorite_border</i>-->
        <img :src="imgSrc" alt="Wishlist">


        <div class="badge-container" v-if="wishlistCount > 0">
            <span class="badge bg-shaka-primary" v-text="wishlistCount"></span>
        </div>

        <!-- <span v-text="__('header.wishlist')" v-if="isText == 'true'"></span> -->
    </a>
</template>

<style lang="scss">
.hide {
    display: none !important;
}
.badge-container{
    position: absolute!important;
    top: 100%;
    right: -3px;
    transform: translate(50%, -50%);
}
.cart-container {
    position: relative!important;
}
</style>

<script type="text/javascript">
export default {
    props: ['isCustomer', 'isText', 'src'],

    data: function() {
        return {
            wishlistCount: 0,
            imgSrc: ''
        };
    },

    watch: {
        '$root.headerItemsCount': function() {
            this.updateHeaderItemsCount();
        }
    },

    created: function() {
        this.updateHeaderItemsCount();
        this.imgSrc = this.$root.baseUrl + "/images/wishlist.svg"
    },

    methods: {
        updateHeaderItemsCount: function() {
            if (this.isCustomer == 'true') {
                this.$http
                    .get(`${this.$root.baseUrl}/items-count`)
                    .then(response => {
                        this.wishlistCount =
                            response.data.wishlistedProductsCount;
                    })
                    .catch(exception => {
                        console.log(this.__('error.something_went_wrong'));
                    });
            }
        }
    }
};
</script>
