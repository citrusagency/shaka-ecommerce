@push('css')
    <style type="text/css">
        .slider{
            height:5px;
            border-radius: 5px;
            background-color: #ddd;
            position: relative;
        }

        .progress{
            height: 5px;
            /* left: 0%;
            right: 0%; */
            position: absolute;
            border-radius: 5px;
            background-color: #333333;
        }

        .range-input{
            position: relative;
        }

        .range-input input{
            position: absolute;
            top:-5px;
            height: 5px;
            width: 100%;
            background: none;
            pointer-events: none;
            appearance:none;
            -webkit-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb{
            height: 17px;
            width: 17px;
            border-radius: 50%;
            pointer-events: auto;
            -webkit-appearance: none;
            background: #333333;
        }

        input[type="range"]::-moz-range-thumb{
            height: 17px;
            width: 17px;
            border:none;
            border-radius: 50%;
            pointer-events: auto;
            -moz-appearance: none;
            background: #333333;
        }
    </style>
@endpush

<div class="layered-filter-wrapper p-0 py-4 left">
    {!! view_render_event('bagisto.shop.products.list.layered-nagigation.before') !!}

    <layered-navigation
        attribute-src="{{ route('catalog.categories.filterable-attributes', $category->id ?? null) }}"
        max-price-src="{{ route('catalog.categories.maximum-price', $category->id ?? null) }}">
    </layered-navigation>

    {!! view_render_event('bagisto.shop.products.list.layered-nagigation.after') !!}
</div>



@push('scripts')
    <script type="text/x-template" id="layered-navigation-template">
        <div v-if="attributes.length > 0">
            <div class="filter-content border border-top-0 row p-0 m-0">
                <div class="col-4 p-0 m-0"></div>
                <div class="filter-attributes col-8 p-0 m-0">
                    <filter-attribute-item
                        v-for='(attribute, index) in categories'
                        :key="index"
                        type="category"
                        :index="index"
                        :attribute="attribute"
                        :sale="categories.length === index+1"
                        :appliedFilterValues="appliedFilters[attribute.code]"
                        :max-price-src="maxPriceSrc"
                        :attributeFilers="appliedFilters"
                        @onSaleFilterAdded="addFilters('isSaleable', $event)"
                        @onFilterAdded="addFilters('category', $event)">
                    </filter-attribute-item>
                </div>
            </div>
            <div class="border border-2 border-top-0 w-100 row m-0 p-0">
                <div class="col-4 m-0 p-0"></div>
                <div class="col-8 m-0 p-0">
                    <h5 class="text-left font-shaka py-3">Price range</h5>
                </div>
                <div class="col-4 m-0 p-0"></div>
                <div class="col-6 m-0 px-0">
                <div class="slider">
                    <div class="progress" :style="{ left: progressLeft, right: progressRight }"></div>
                </div>
                    <div class="range-input">
                        <input type="range" id="minPriceFilter" @change="applyPriceRangeFilter" class="range-min cursor-pointer" min="0" :max="maxPriceByCategory" step="10" v-model="appliedFilters.price[0]" />
                        <input type="range" id="maxPriceFilter" @change="applyPriceRangeFilter" class="range-max cursor-pointer" min="0" :max="maxPriceByCategory" step="10" v-model="appliedFilters.price[1]" />
                    </div>
                    <div class="flex row justify-content-between my-3 px-3">
                        <p>@{{ appliedFilters.price[0] }} </p>
                        <p>@{{ appliedFilters.price[1] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/x-template" id="filter-attribute-item-template">

        <div>
            <div class="price-range-wrapper" v-if="attribute.type === 'price'">
                <vue-slider
                    ref="slider"
                    v-model="sliderConfig.value"
                    :process-style="sliderConfig.processStyle"
                    :tooltip-style="sliderConfig.tooltipStyle"
                    :max="sliderConfig.max"
                    :lazy="true"
                    @change="priceRangeUpdated($event)"
                ></vue-slider>

                <div class="filter-input row col-12 no-padding">
                    <div class="d-flex w-100 justify-content-between">
                        <span class="pl-3" v-text="sliderConfig.value[0]"></span>
                        <span v-text="sliderConfig.value[1]"></span>
                    </div>
                </div>
            </div>
            <div v-if="attribute.type === 'category'">
                <div v-if="attribute.children.length === 0">
                    <h6 @click="changeCategory(attribute.id)" class="text-uppercase display-inbl cursor-pointer" >@{{ attribute.name ? attribute.name : attribute.admin_name }}</h6>
                </div>
                <div :class="`cursor-pointer filter-attributes-item border-bottom-0 ${active ? 'active' : ''}`" v-else>
                    <div class="filter-attributes-title" @click="active = ! active">
                        <h6 class="text-uppercase display-inbl cursor-pointer">@{{ attribute.name ? attribute.name : attribute.admin_name }}</h6>

                        <div class="float-right display-table pr-4">
                            {{--                    <span class="link-color cursor-pointer" v-if="appliedFilters.length" @click.stop="clearFilters()">--}}
                            {{--                        {{ __('shop::app.products.remove-filter-link-title') }}--}}
                            {{--                    </span>--}}

                            <i :class="`icon text-right fs16 cell ${active ? 'rango-arrow-up' : 'rango-arrow-down'}`"></i>
                        </div>
                    </div>
                    <div class="filter-attributes-content border-bottom-0">
                        <ul type="none" class="items px-0 mx-0">
                            <li
                                class="item"
                                v-for='(option, index) in attribute.children'>
                                <div
                                    class="checkbox"
                                    @click="changeCategory(option.id)">
                                    {{--                                    <input--}}
                                    {{--                                        style="opacity: 0"--}}
                                    {{--                                        type="radio"--}}
                                    {{--                                        :id="option.id"--}}
                                    {{--                                        v-bind:value="option.id"--}}
                                    {{--                                        v-model="appliedFilters"--}}
                                    {{--                                        @change="addFilter($event)"/>--}}
                                    <span :class="`${isActiveCategory(option.id) ? 'font-weight-bold' : ''}`">@{{ option.name ? option.name : option.admin_name }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div v-if="sale">
                    <h6 @click="filterSale" class="text-uppercase display-inbl text-shaka cursor-pointer">SALE</h6>
                </div>
            </div>
            <div :class="`cursor-pointer border-0 filter-attributes-item ${active ? 'active' : ''}`" v-if="attribute.code === 'material'">
                {{--                <div class="filter-attributes-title" @click="active = ! active">--}}
                {{--                    <h6 class="fw6 display-inbl">@{{ attribute.name ? attribute.name : attribute.admin_name }}</h6>--}}

                {{--                    <div class="float-right display-table">--}}
                {{--                    <span class="link-color cursor-pointer" v-if="appliedFilters.length" @click.stop="clearFilters()">--}}
                {{--                        {{ __('shop::app.products.remove-filter-link-title') }}--}}
                {{--                    </span>--}}

                {{--                        <i :class="`icon fs16 cell ${active ? 'rango-arrow-up' : 'rango-arrow-down'}`"></i>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="filter-attributes-content py-4 px-0 mx-0">
                    <ul type="none" class="items p-0 m-0" v-if="attribute.type != 'price'">
                        <li
                            class="item"
                            v-for='(option, index) in attribute.options'>
                            <div
                                class="checkbox"
                                @click="optionClicked(option.id, $event)">
                                <input
                                    type="checkbox"
                                    :id="option.id"
                                    v-bind:value="option.id"
                                    v-model="appliedFilters"
                                    @change="addFilter($event)"/>
                                <span>@{{ option.label ? option.label : option.admin_name }}</span>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </script>

    <script>

        Vue.component('layered-navigation', {
            template: '#layered-navigation-template',

            props: [
                'attributeSrc',
                'maxPriceSrc',
            ],

            data: function () {
                return {
                    maxPriceByCategory: 1000,
                    appliedFilters: {
                        price: [0, 0]
                    },
                    attributes: [],
                    categories: [],
                    materials: []
                }
            },

            created: function () {
                this.setMaxPrice();
                this.setFilterAttributes();
                this.setAppliedFilters();
            },

            computed: {
                progressLeft: function() {
                    const minPriceInput = this.appliedFilters.price[0];

                    return (minPriceInput / this.maxPriceByCategory) * 100 + '%';
                },
                progressRight: function() {
                    const maxPriceInput = this.appliedFilters.price[1];

                    return 100 - (maxPriceInput / this.maxPriceByCategory) * 100 + '%';
                }
            },

            methods: {
                setFilterAttributes: function () {
                    axios
                        .get(this.attributeSrc)
                        .then((response) => {
                            this.attributes = response.data.filter_attributes;
                            this.categories = response.data.categories
                            this.materials[0] = this.attributes[1]
                        });
                },

                setAppliedFilters: function () {
                    let urlParams = new URLSearchParams(window.location.search);

                    urlParams.forEach((value, index) => {
                        this.appliedFilters[index] = value.split(',');
                    });
                },

                setMaxPrice: function (){
                    axios
                        .get(this.maxPriceSrc)
                        .then((response) => {
                            this.maxPriceByCategory = Math.ceil(response.data.max_price / 10) * 10;
                            if(this.appliedFilters.price[1]===0){
                                this.appliedFilters.price[1] = this.maxPriceByCategory
                            }
                        });
                },

                addFilters: function (attributeCode, filters) {

                    if(attributeCode ==='isSaleable'){
                        // If isSaleable is already applied, set its value to false
                        if (this.appliedFilters.hasOwnProperty('isSaleable')){
                            delete this.appliedFilters['isSaleable'];
                        }else {
                            this.appliedFilters['isSaleable'] = [true];
                        }
                    }
                    else {
                        if (filters.length) {
                            this.appliedFilters[attributeCode] = filters;
                        } else {
                            delete this.appliedFilters[attributeCode];
                        }
                    }

                    this.applyFilter();
                },

                applyFilter: function () {
                    let params = [];

                    for (key in this.appliedFilters) {
                        if (key != 'page') {
                            params.push(key + '=' + this.appliedFilters[key].join(','));
                        }
                    }

                    window.location.href = "?" + params.join('&');
                },

                applyPriceRangeFilter: function (){
                    let minPrice = document.getElementById("minPriceFilter").value;
                    let maxPrice = document.getElementById("maxPriceFilter").value;

                    this.appliedFilters.price = [minPrice, maxPrice];
                    this.applyFilter();
                }
            }
        });

        Vue.component('filter-attribute-item', {
            template: '#filter-attribute-item-template',

            props: [
                'index',
                'attribute',
                'addFilters',
                'appliedFilterValues',
                'maxPriceSrc',
                'type',
                'attributeFilers',
                'sale',
                'applyPriceRangeFilter'
            ],

            data: function () {
                return {
                    active: true,

                    appliedFilters: [],

                    sliderConfig: {
                        max: 500,

                        value: [0, 0],

                        processStyle: {
                            "backgroundColor": "#FF6472"
                        },

                        tooltipStyle: {
                            "borderColor": "#FF6472",
                            "backgroundColor": "#FF6472",
                        },

                        priceTo: 0,

                        priceFrom: 0,
                    }
                }
            },

            created: function () {
                if (!this.index) this.active = true;

                if (this.appliedFilterValues && this.appliedFilterValues.length) {
                    this.appliedFilters = this.appliedFilterValues;

                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = this.appliedFilterValues;
                        this.sliderConfig.priceFrom = this.appliedFilterValues[0];
                        this.sliderConfig.priceTo = this.appliedFilterValues[1];
                    }

                    this.active = true;
                }

                //this.setMaxPrice();
            },

            methods: {

                isActiveCategory: function(id){
                    if (this.attributeFilers.hasOwnProperty('category')){
                        return this.attributeFilers['category'].includes(id.toString())
                    }
                    return false
                },

                addFilter: function (e) {
                    this.$emit('onFilterAdded', this.appliedFilters);
                },

                priceRangeUpdated: function (value) {
                    this.appliedFilters = value;
                    this.$emit('onFilterAdded', this.appliedFilters);
                },

                clearFilters: function () {
                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = [0, 0];
                    }

                    this.appliedFilters = [];

                    this.$emit('onFilterAdded', this.appliedFilters);
                },

                changeCategory: function (id) {
                    this.appliedFilters.push(id);
                    this.$emit('onFilterAdded', this.appliedFilters);
                },

                filterSale: function() {
                    this.appliedFilters.push(true);
                    this.$emit('onSaleFilterAdded', this.appliedFilters);

                },

                optionClicked: function (id, {target}) {
                    let checkbox = $(`#${id}`);

                    if (checkbox && checkbox.length > 0 && target.type != "checkbox") {
                        checkbox = checkbox[0];
                        checkbox.checked = !checkbox.checked;

                        if (checkbox.checked) {
                            this.appliedFilters.push(id);
                        } else {
                            let idPosition = this.appliedFilters.indexOf(id);

                            if (idPosition == -1)
                                idPosition = this.appliedFilters.indexOf(id.toString());

                            this.appliedFilters.splice(idPosition, 1);
                        }

                        this.addFilter(event);
                    }
                }
            }
        });
    </script>
@endpush