<template>
    <div class="cart-container">
        <div class=" btn btn-link" id="mini-cart" :class="{'cursor-not-allowed': ! cartItems.length}">
            <div class="mini-cart-content">
                <i class="material-icons-outlined text-white">shopping_cart</i>
                <div class="badge-container ">
                    <span class="badge bg-shaka-primary" v-text="cartItems.length" v-if="cartItems.length != 0"></span>
                </div>
                <!-- <span class="fs18 fw6 cart-text text-white" v-text="cartText"></span> -->
            </div>

        </div>


    </div>
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

<script>
export default {
    props: [
        'isTaxInclusive',
        'viewCartRoute',
        'checkoutRoute',
        'checkMinimumOrderRoute',
        'cartText',
        'viewCartText',
        'checkoutText',
        'subtotalText'
    ],

    data: function() {
        return {
            cartItems: [],
            cartInformation: []
        };
    },

    mounted: function() {
        this.getMiniCartDetails();
    },

    watch: {
        '$root.miniCartKey': function() {
            this.getMiniCartDetails();
        }
    },

    methods: {
        getMiniCartDetails: function() {
            this.$http
                .get(`${this.$root.baseUrl}/mini-cart`)
                .then(response => {
                    if (response.data.status) {
                        this.cartItems = response.data.mini_cart.cart_items;
                        this.cartInformation =
                            response.data.mini_cart.cart_details;
                    }
                })
                .catch(exception => {
                    console.log(this.__('error.something_went_wrong'));
                });
        },

        removeProduct: function(productId) {
            this.$http
                .delete(`${this.$root.baseUrl}/cart/remove/${productId}`)
                .then(response => {
                    this.cartItems = this.cartItems.filter(
                        item => item.id != productId
                    );
                    this.$root.miniCartKey++;

                    window.showAlert(
                        `alert-${response.data.status}`,
                        response.data.label,
                        response.data.message
                    );
                })
                .catch(exception => {
                    console.log(this.__('error.something_went_wrong'));
                });
        },

        checkMinimumOrder: function(e) {
            e.preventDefault();

            this.$http.post(this.checkMinimumOrderRoute).then(({ data }) => {
                if (!data.status) {
                    window.showAlert(`alert-warning`, 'Warning', data.message);
                } else {
                    window.location.href = this.checkoutRoute;
                }
            });
        }
    }
};
</script>
