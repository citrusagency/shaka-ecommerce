@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

{!! view_render_event('bagisto.shop.products.list.toolbar.before') !!}
    <toolbar-component></toolbar-component>
{!! view_render_event('bagisto.shop.products.list.toolbar.after') !!}

@push('scripts')
    <script type="text/x-template" id="toolbar-template">
        <div class="toolbar-wrapper d-flex font-shaka-open-sans fs16" style="margin-left:30px;" v-if="!isMobile()">
            <div class="sorter">
                <label>{{ __('shop::app.products.sort-by') }}</label>

                <select class="border-normal px-2" onchange="window.location.href = this.value" aria-label="Sort By">
                    @foreach ($toolbarHelper->getAvailableOrders() as $key => $order)
                        <option value="{{ $toolbarHelper->getOrderUrl($key) }}" {{ $toolbarHelper->isOrderCurrent($key) ? 'selected' : '' }}>
                            {{ __('shop::app.products.' . $order) }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="limiter">
                <label>{{ __('shop::app.products.show') }}</label>

                <select class=" border-normal px-2" onchange="window.location.href = this.value" aria-label="Show">

                    @foreach ($toolbarHelper->getAvailableLimits() as $limit)

                        <option value="{{ $toolbarHelper->getLimitUrl($limit) }}" {{ $toolbarHelper->isLimitCurrent($limit) ? 'selected' : '' }}>
                            {{ $limit }}
                        </option>

                    @endforeach

                </select>

            </div>
        </div>

        <div class="toolbar-wrapper row col-12 remove-padding-margin fs16 font-shaka-open-sans" v-else>
            <div
                v-if="layeredNavigation"
                class="nav-container scrollable mx-0"
                style="
                    color: black;
                    position: relative;
                ">
                <div class="header drawer-section">
                    <i class="material-icons" @click="toggleLayeredNavigation">keyboard_backspace</i>
                    <span class="fs24 fw6">
                        {{ __('velocity::app.shop.general.filter') }}
                    </span>

                </div>

                @if (request()->route()->getName() != 'velocity.search.index')
                    @include ('shop::products.list.layered-navigation')
                @endif
            </div>

		<div class="d-flex w-100 justify-content-between spacing">
		    <div class="mx-3" @click="toggleLayeredNavigation({event: $event, actionType: 'open'})">
		        <a class="unset">
		            <i class="material-icons">filter_list</i>
		            <span>{{ __('velocity::app.shop.general.filter') }}</span>
		        </a>
		    </div>


			<div class="mx-3">
			    <i class="material-icons">sort_by_alpha</i>

			    <select class="selective-div no-border" onchange="window.location.href = this.value">
			        @foreach ($toolbarHelper->getAvailableOrders() as $key => $order)
			            <option value="{{ $toolbarHelper->getOrderUrl($key) }}" {{ $toolbarHelper->isOrderCurrent($key) ? 'selected' : '' }}>
			                {{ __('shop::app.products.' . $order) }}
			            </option>
			        @endforeach
			    </select>
			</div>

		    <div class="mx-3">

		    </div>
		</div>

        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('toolbar-component', {
                template: '#toolbar-template',
                data: function () {
                    return {
                        'layeredNavigation': false,
                    }
                },

                watch: {
                    layeredNavigation: function (value) {
                        if (value) {
                            document.body.classList.add('open-hamburger');
                        } else {
                            document.body.classList.remove('open-hamburger');
                        }
                    }
                },

                methods: {
                    toggleLayeredNavigation: function ({event, actionType}) {
                        this.layeredNavigation = !this.layeredNavigation;
                    },
                }
            })
        })()
    </script>
@endpush
