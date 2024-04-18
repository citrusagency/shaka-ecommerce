<country-state></country-state>

@push('scripts')

{{--   TODO IF YOU TRY TO PASTE SOMETHING HERE PHP STROM WILL CRASH--}}

    <script type="text/x-template" id="country-state-template">
        <div class="control-group row mb-lg-4 mb-md-2">
            <div class="col-lg-6 col-md-12 control-group" :class="[errors.has('country') ? 'has-error' : '']">
                <label for="country form-label" class="{{ core()->isCountryRequired() ? 'mandatory' : '' }}">
                    {{ __('shop::app.customer.account.address.create.country') }}
                </label>

                <select
                    class="form-control"
                    id="country"
                    type="text"
                    name="country"
                    v-model="country"
                    v-validate="'{{ core()->isCountryRequired() ? 'required' : '' }}'"
                    data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.country') }}&quot;">
                    <option value="">{{ __('Select Country') }}</option>

                    @foreach (core()->countries() as $country)
                        <option {{ $country->code === $defaultCountry ? 'selected' : '' }}  value="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                </select>



                <span
                    class="control-error"
                    v-text="errors.first('country')"
                    v-if="errors.has('country')">
                </span>
            </div>

            <div class="col-lg-6 col-md-12 control-group" :class="[errors.has('state') ? 'has-error' : '']">
                <label for="state form-label" class="{{ core()->isStateRequired() ? 'mandatory' : '' }}">
                    {{ __('shop::app.customer.account.address.create.state') }}
                </label>

                <input
                    class="form-control "
                    id="state"
                    type="text"
                    name="state"
                    v-model="state"
                    v-validate="'{{ core()->isStateRequired() ? 'required' : '' }}'"
                    data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;"
                    v-if="! haveStates()"/>

                <template v-if="haveStates()">
                    <select
                        class="custom-select"
                        id="state"
                        name="state"
                        v-model="state"
                        v-validate="'{{ core()->isStateRequired() ? 'required' : '' }}'"
                        data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;">

                        <option value="">{{ __('shop::app.customer.account.address.create.select-state') }}</option>

                        <option v-for='(state, index) in countryStates[country]' :value="state.code">
                            @{{ state.default_name }}
                        </option>
                    </select>


                </template>

                <span
                    class="control-error"
                    v-text="errors.first('state')"
                    v-if="errors.has('state')">
                </span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('country-state', {
            template: '#country-state-template',

            inject: ['$validator'],

            data: function () {
                return {
                    country: "{{ $countryCode ?? $defaultCountry }}",

                    state: "{{ $stateCode }}",

                    countryStates: @json(core()->groupedStatesByCountries())
                }
            },

            methods: {
                haveStates: function () {
                    if (this.countryStates[this.country] && this.countryStates[this.country].length)
                        return true;

                    return false;
                },
            }
        });
    </script>
@endpush