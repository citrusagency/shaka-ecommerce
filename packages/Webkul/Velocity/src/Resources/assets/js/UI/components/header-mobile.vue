<template>
    <div class="row py-3">
        <div class="col-6" >
            <div v-if="hamburger" class="nav-container scrollable">
                <div class="wrapper" v-if="this.rootCategories" >
                    <div class="greeting drawer-section fw6" >
                        <span class="menu-title"> Menu </span>
                            <span class="close-container" @click="closeDrawer()" >
                               <i class="material-icons float-right text-white close-icon">
                                    close
                                </i>
                            </span>
                    </div>

                    <ul
                        class="velocity-content"
                        v-if="headerContent.length > 0"
                    >
                        <li
                            :key="index"
                            v-for="(content, index) in headerContent"
                        >
                            <a
                                class="unset"
                                v-text="content.title"
                                :href="`${$root.baseUrl}/${content.page_link}`"
                            >
                            </a>
                        </li>
                    </ul>

                    <ul
                        type="none"
                        class="category-wrapper"
                        v-if="rootCategoriesCollection.length > 0"
                    >
                        <li
                            v-for="(
                                category, index
                            ) in rootCategoriesCollection"
                            :key="index"
                        >
                            <a
                                class="unset"
                                :href="`${$root.baseUrl}/${category.slug}`"
                            >
                                <div class="category-logo">
                                    <img
                                        class="category-icon"
                                        v-if="category.category_icon_url"
                                        :src="category.category_icon_url"
                                        alt=""
                                        width="20"
                                        height="20"
                                    />
                                </div>

                                <span v-text="category.name"></span>
                            </a>

                            <i
                                class="rango-arrow-right"
                                @click="toggleSubcategories(index, $event)"
                                v-if="category.children.length > 0"
                            ></i>
                        </li>
                    </ul>

                    <slot name="customer-navigation"></slot>

                    <ul class="meta-wrapper">
                        <slot name="extra-navigation"></slot>
                    </ul>
                </div>
            </div>

            <div class="row" style="height: 100%;">
                <div class="align-content-center col-12 d-flex flex-column justify-content-center"
                     style="height: 100%; ">
                    <div class="mr-4" @click="toggleHamburger">
                        <i class="rango-toggle hamburger" style="font-size: 25px!important"></i>
                    </div>
                    <slot name="logo"></slot>
                </div>
            </div>
        </div>

        <div class="right-vc-header col-6">
            <slot name="top-header"></slot>
        </div>
    </div>
</template>

<style lang="scss">
.close-container {
    position: fixed;
    left: 0;
    top: 0;
    background: black;
    width: 15%;
    height: 57px;
    display: grid !important;
    place-items: center;
}
.menu-title{
    color: #232427;
    padding: 5px;
    font-family: Outfit, sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 16px; /* 100% */
    letter-spacing: 1.6px;
    text-transform: uppercase;
}
.mobile-header-links{
    color: #232427;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    text-transform: uppercase;
}
</style>

<script type="text/javascript">
export default {
    props: [
        'isCustomer',
        'heading',
        'headerContent',
        'categoryCount',
        'cartItemsCount',
        'cartRoute',
        'locale',
        'allLocales',
        'currency',
        'allCurrencies',
    ],

    data: function () {
        return {
            compareCount: 0,
            wishlistCount: 0,
            languages: false,
            hamburger: false,
            currencies: false,
            subCategory: null,
            isSearchbar: false,
            rootCategories: true,
            rootCategoriesCollection: this.$root.sharedRootCategories,
            updatedCartItemsCount: this.cartItemsCount,
        };
    },

    watch: {
        hamburger: function (value) {
            if (value) {
                document.body.classList.add('open-hamburger');
            } else {
                document.body.classList.remove('open-hamburger');
            }
        },

        '$root.headerItemsCount': function () {
            this.updateHeaderItemsCount();
        },

        '$root.miniCartKey': function () {
            this.getMiniCartDetails();
        },

        '$root.sharedRootCategories': function (categories) {
            this.formatCategories(categories);
        },
    },

    created: function () {
        this.getMiniCartDetails();
        this.updateHeaderItemsCount();
    },

    methods: {
        openSearchBar: function () {
            this.isSearchbar = !this.isSearchbar;

            let footer = $('.footer');
            let homeContent = $('#home-right-bar-container');

            if (this.isSearchbar) {
                footer[0].style.opacity = '.3';
                homeContent[0].style.opacity = '.3';
            } else {
                footer[0].style.opacity = '1';
                homeContent[0].style.opacity = '1';
            }
        },

        toggleHamburger: function () {
            this.hamburger = !this.hamburger;
        },

        closeDrawer: function () {
            $('.nav-container').hide();

            this.toggleHamburger();
            this.rootCategories = true;
        },

        toggleSubcategories: function (index, event) {
            if (index == 'root') {
                this.rootCategories = true;
                this.subCategory = false;
            } else {
                event.preventDefault();

                let categories = this.$root.sharedRootCategories;
                this.rootCategories = false;
                this.subCategory = categories[index];
            }
        },

        toggleMetaInfo: function (metaKey) {
            this.rootCategories = !this.rootCategories;

            this[metaKey] = !this[metaKey];
        },

        updateHeaderItemsCount: function () {
            if (this.isCustomer != 'true') {
                let comparedItems = this.getStorageValue('compared_product');

                if (comparedItems) {
                    this.compareCount = comparedItems.length;
                }
            } else {
                this.$http
                    .get(`${this.$root.baseUrl}/items-count`)
                    .then((response) => {
                        this.compareCount = response.data.compareProductsCount;
                        this.wishlistCount =
                            response.data.wishlistedProductsCount;
                    })
                    .catch((exception) => {
                        console.log(this.__('error.something_went_wrong'));
                    });
            }
        },

        getMiniCartDetails: function () {
            this.$http
                .get(`${this.$root.baseUrl}/mini-cart`)
                .then((response) => {
                    if (response.data.status) {
                        this.updatedCartItemsCount =
                            response.data.mini_cart.cart_items.length;
                    }
                })
                .catch((exception) => {
                    console.log(this.__('error.something_went_wrong'));
                });
        },

        formatCategories: function (categories) {
            let slicedCategories = categories;
            let categoryCount = this.categoryCount ? this.categoryCount : 9;

            if (slicedCategories && slicedCategories.length > categoryCount) {
                slicedCategories = categories.slice(0, categoryCount);
            }

            this.rootCategoriesCollection = slicedCategories;
        },
    },
};
</script>
