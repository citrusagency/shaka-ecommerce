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
            <div class="row border border-2 w-100 m-0 p-0">
            </div>
            <div class="filter-content border border-top-0 row px-0 py-4 m-0">
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
            <!-- <div class="filter-content border border-top-0 row m-0 p-0">
                <div class="col-4 p-0 m-0"></div>
                <div class="filter-attributes p-0 m-0 col-8 border-0">
                    <filter-attribute-item
                        v-for='(attribute, index) in materials'
                        :key="index"
                        :index="index"
                        :attribute="attribute"
                        :appliedFilterValues="appliedFilters[attribute.code]"
                        :max-price-src="maxPriceSrc"
                        @onFilterAdded="addFilters(attribute.code, $event)">
                    </filter-attribute-item>
                </div>
            </div> -->
            <div class="border border-2 border-top-0 w-100 row m-0 p-0">
                <div class="col-4 m-0 p-0"></div>
                <div class="col-8 m-0 p-0">
                    <h5 class="text-left font-shaka py-3">Price range</h5>
                </div>
                <div class="col-4 m-0 p-0"></div>
                <div class="col-6 m-0 py-3 px-0">
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max="1000" value="250" />
                        <input type="range" class="range-max" min="0" max="1000" value="750" />
                    </div>
                </div>
            </div>
            <div data-role="main" class="ui-content">
                
            </div>
            <!-- <div class="filter-content border border-top-0 row p-0 m-0">
                <div class="col-4 p-0 m-0"></div>

                <div class="filter-attributes p-0 col-8 m-0 py-4 pr-4">
                    <filter-attribute-item
                        :attribute="attributes[2]"
                        :appliedFilterValues="appliedFilters[attributes[2].code]"
                        :max-price-src="maxPriceSrc"
                        @onFilterAdded="addFilters(attributes[2].code, $event)">
                    </filter-attribute-item>
                </div>
            </div> -->
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
                    <h6 @click="changeCategory(attribute.id)" class="text-uppercase display-inbl">@{{ attribute.name ? attribute.name : attribute.admin_name }}</h6>
                </div>
                <div :class="`cursor-pointer filter-attributes-item border-bottom-0 ${active ? 'active' : ''}`" v-else>
                    <div class="filter-attributes-title" @click="active = ! active">
                        <h6 class="text-uppercase display-inbl">@{{ attribute.name ? attribute.name : attribute.admin_name }}</h6>

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
                    <h6 @click="filterSale" class="text-uppercase display-inbl text-shaka">SALE</h6>
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
                    appliedFilters: {},
                    attributes: [],
                    categories: [],
                    materials: [],
                }
            },

            created: function () {
                this.setFilterAttributes();

                this.setAppliedFilters();
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
                'sale'

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

                this.setMaxPrice();
            },

            methods: {

                isActiveCategory: function(id){
                    if (this.attributeFilers.hasOwnProperty('category')){
                        return this.attributeFilers['category'].includes(id.toString())
                    }
                    return false
                },
                setMaxPrice: function () {
                    if (this.attribute['code'] != 'price') {
                        return;
                    }

                    axios
                        .get(this.maxPriceSrc)
                        .then((response) => {
                            let maxPrice = response.data.max_price;
                            this.sliderConfig.max = maxPrice ? ((parseInt(maxPrice) !== 0 || maxPrice) ? parseInt(maxPrice) : 500) : 500;

                            if (!this.appliedFilterValues) {
                                this.sliderConfig.value = [0, this.sliderConfig.max];
                                this.sliderConfig.priceTo = this.sliderConfig.max;
                            }
                        });
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
                    console.log(id)
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
