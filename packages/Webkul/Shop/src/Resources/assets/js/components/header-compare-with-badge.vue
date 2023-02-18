<template>
<li class="compare-dropdown-container cart-container">
    <a :href="src" @endauth style="color: #242424;">

        <i class="icon wishlist-icon"></i>
        <span class="name badge-container">
            {{ text }}
            <span class="count">(<span>{{ compareCount ? compareCount : 0 }}</span>)</span>
        </span>
    </a>
</li>
</template>

<script>
export default {
    props: ['isCustomer', 'text', 'src'],

    data: function () {
        return {
            compareCount: 0
        };
    },

    created: function () {
        this.updateHeaderItemsCount();
    },

    methods: {
        updateHeaderItemsCount: function () {

            this.$http
                .get(`${this.$root.baseUrl}/items-count`)
                .then(response => {

                    this.compareCount = response.data.wishlistedProductsCount;
                });
        }
    }
};
</script>
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
