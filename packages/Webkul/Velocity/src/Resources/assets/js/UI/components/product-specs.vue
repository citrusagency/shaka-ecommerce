<template>
    <div class="w-100">
        <div class="tabs ">
            <div class="tab "
                 v-if="product.product.specifications"
                 :class="{ active: activeTab === 'specifications' }"
                 @click="activeTab = 'specifications'">
                Specifications
            </div>
            <div class="tab "
                 v-if="product.product.washing_tips"
                 :class="{ active: activeTab === 'washingtips' }"
                 @click="activeTab = 'washingtips'">
                Washing tips
            </div>
            <div class="tab "
                 v-if="product.product.delivery"
                 :class="{ active: activeTab === 'delivery' }"
                 @click="activeTab = 'delivery'">
                Delivery
            </div>
        </div>

        <div class="tab-content" v-if="activeTab === 'specifications'" v-html="product.product.specifications">
        </div>

        <div class="tab-content" v-if="activeTab === 'washingtips'" v-html="product.product.washing_tips">
        </div>

        <div class="tab-content" v-if="activeTab === 'delivery'" v-html="product.product.delivery">
        </div>
    </div>
</template>

<style lang="scss">
.tab {
    cursor: pointer;
    // Add your styles
}
.tabs {
    display: flex;
    justify-content: center;
}
.tab {
    display: inline-block;
    margin-right: 70px;
    //padding-bottom: 20px;
    margin-bottom: 10px;
    padding: 10px;
    font-size: 1.5em;
    position: relative;
    cursor: pointer;

    &:last-child {
        margin-right: 0;
    }

    &::after {
        content: "";
        position: absolute;
        display: block;
        margin: auto;
        border-radius: 50rem!important;
        height: 3px;
        width: 50%;
        background: transparent;
        transition: background 0.3s ease-in-out;
        top: 50px;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    &.active::after {
        background: #1197C2 !important;
    }
}

.tab-content {
    padding: 40px;
    border: 1px solid gray;
    color: #777777;
    border-radius: 5px;
    // Add your styles
}

.active {
    // Add your active styles
}

.tab-content {
    // Add your styles
}
</style>

<script type="text/javascript">
export default {
    props: [
        'list',
        'product',
    ],

    data() {
        return {
            activeTab: 'specifications'
        }
    },

    methods: {
        isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }
    }
}
</script>
