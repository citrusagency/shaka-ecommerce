<template>
    <div
        :class="`quantity control-group ${
            errors.has(controlName) ? 'has-error' : ''
        }`"
    >
        <label
            class="required"
            style="width:120px;"
            for="quantity-changer"
            v-text="quantityText"
        ></label>

        <div class="input-btn-group">
            <button type="button" class="decrease" @click="decreaseQty()">
                <i class="rango-minus"></i>
            </button>

            <input
                ref="quantityChanger"
                :name="controlName"
                :model="qty"
                class="control"
                id="quantity-changer"
                v-validate="validations"
                :data-vv-as="`&quot;${quantityText}&quot;`"
                @keyup="setQty($event)"
            />

            <button type="button" class="increase" @click="increaseQty()">
                <i class="rango-plus"></i>
            </button>
        </div>

        <span class="control-error" v-if="errors.has(controlName)">{{
            errors.first(controlName)
        }}</span>
    </div>
</template>

<script>
export default {
    template: '#quantity-changer-template',

    inject: ['$validator'],

    props: {
        controlName: {
            type: String,
            default: 'quantity'
        },

        quantity: {
            type: [Number, String],
            default: 1
        },

        quantityText: {
            type: String,
            default: 'Quantity'
        },

        minQuantity: {
            type: [Number, String],
            default: 1
        },

        productId: {
            type: [Number, String],
            default: null
        },

        cartItemId: {
            type: [Number, String],
            default: null
        },

        validations: {
            type: String,
            default: 'required|numeric|min_value:1'
        }
    },

    data: function() {
        return {
            qty: this.quantity,
            maxQuantity: 100,
        };
    },

    mounted: function() {
        this.$refs.quantityChanger.value = this.qty > this.minQuantity
            ? this.qty
            : this.minQuantity;

        this.fetchMaxQuantity();
    },

    watch: {
        qty: function(val) {
            this.$refs.quantityChanger.value = ! isNaN(parseFloat(val)) ? val : 0;

            this.qty = ! isNaN(parseFloat(val)) ? this.qty : 0;

            this.$emit('onQtyUpdated', this.qty);

            this.$validator.validate();
        }
    },

    methods: {
        setQty: function({ target }) {
            this.qty = parseInt(target.value);
        },

        decreaseQty: function() {
            if (this.qty > this.minQuantity) this.qty = parseInt(this.qty) - 1;
            this.removeFromCart();
        },

        increaseQty: function() {
            if (this.qty < this.maxQuantity) this.qty = parseInt(this.qty) + 1;
            this.addToCart();
        },

        fetchMaxQuantity: function() {
            axios.get(`${this.baseUrl}/product-inventory/${this.productId}`)
                .then(response => {
                    this.maxQuantity = response.data.maxQuantity;
                })
                .catch(error => {
                    console.error('Error fetching max quantity:', error);
                });
        },

        addToCart: function () {
            let url = `${this.$root.baseUrl}/cart/add`;

            this.$http.post(url, {
                'quantity': 1,
                'product_id': this.productId,
                '_token': this.csrfToken,
            })
                .then(response => {
                    window.location.reload();
                    window.showAlert(`alert-success`, this.__('shop.general.alert.success'), response.data.message);
                })
                .catch(error => {
                    console.error('Error removing item from cart:', error);
                })
        },

        removeFromCart: function () {
            let url = `${this.$root.baseUrl}/cart/remove/${this.cartItemId}`;

            axios.delete(url,{
                data: {
                    _token: this.csrfToken
                }})
                .then(response => {
                    window.location.reload();
                    window.showAlert(`alert-success`, this.__('shop.general.alert.success'), response.data.message);
                })
                .catch(error => {
                    console.error('Error removing item from cart:', error);
                });
        },
    }
};
</script>
