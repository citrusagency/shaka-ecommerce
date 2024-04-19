<template>
    <form method="POST" @submit.prevent="addToCart" class="m-0 p-0">
        <button
            type="submit"
            :disabled="isButtonEnable == 'false' || isButtonEnable == false"
            class="btn bg-transparent text-white atc-btn"
            style="display: flex !important; padding-top: 5px; line-height: 27px !important;"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="#1197C2"/>
            </svg>
            <span :class="`${addClassToBtn}`"  v-text="btnText"></span>
        </button>
    </form>
</template>

<style type="text/css">
    .add-to-bag-btn{
        color: red;
    }
</style>

<script>
    export default {
        props: [
            'form',
            'btnText',
            'isEnable',
            'csrfToken',
            'productId',
            'reloadPage',
            'moveToCart',
            'wishlistMoveRoute',
            'showCartIcon',
            'addClassToBtn',
            'productFlatId',
        ],

        data: function () {
            return {
                'isButtonEnable': this.isEnable,
                'qtyText': this.__('checkout.qty'),
            }
        },

        methods: {
            'addToCart': function () {
                this.isButtonEnable = false;
                let url = `${this.$root.baseUrl}/cart/add`;

                this.$http.post(url, {
                    'quantity': 1,
                    'product_id': this.productId,
                    '_token': this.csrfToken.split("&#039;").join(""),
                })
                .then(response => {
                    this.isButtonEnable = true;

                    if (response.data.status == 'success') {
                        this.$root.miniCartKey++;

                        window.showAlert(`alert-success`, this.__('shop.general.alert.success'), response.data.message);

                        if (this.reloadPage == "1") {
                            window.location.reload();
                        }
                    } else {

                        if (response.data.redirectionRoute) {
                            window.location.href = response.data.redirectionRoute;
                        }
                    }
                })
                .catch(error => {
                    console.log(this.__('error.something_went_wrong'));
                })
            },
        }
    }
</script>