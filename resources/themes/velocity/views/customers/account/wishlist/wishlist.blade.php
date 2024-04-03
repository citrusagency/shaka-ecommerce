@inject('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.wishlist.page-title') }}
@endsection

@push('css')
    <style type="text/css">
        .wishlist-cont{
            width: 100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: left;
            align-items: flex-start;
            gap:24px;
        }
        .remove-btn{
            margin-top:5px;
            background-color: #efefef;
            border-radius: 50%;
            padding: 3px 8px;
            color:black !important;
            border: none;
        }
        .remove-btn:hover{
            background-color: #cecece;
        }
        .add-to-bag-link{
            padding: 8px;
            display: inline;
        }

        @media (max-width: 992px){
            .wishlist-cont{
                justify-content: space-evenly;
            }
        }

    </style>
@endpush

@section('page-detail-wrapper')
    <div class="account-head page-title-container">
        <div class="profile-content-title">
            {{ __('shop::app.customer.account.wishlist.title') }}
        </div>

        @if (count($items))
            <span class="kz-link">
                <form id="remove-all-wishlist" class="d-none" action="{{ route('customer.wishlist.removeall') }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>

                @if ($isSharingEnabled)
                    <a
                        class="remove-decoration theme-btn light"
                        href="javascript:void(0);"
                        onclick="window.showShareWishlistModal();">
                        {{ __('shop::app.customer.account.wishlist.share') }}
                    </a>
                @endif

                <a
                    class="remove-decoration" style="color:#1197C2; font-weight: 500;"
                    href="javascript:void(0);"
                    onclick="window.deleteAllWishlist();">
                    {{ __('shop::app.customer.account.wishlist.removeall') }}
                </a>
            </span>
        @endif
    </div>

    {!! view_render_event('bagisto.shop.customers.account.wishlist.list.before', ['wishlist' => $items]) !!}

    <div class="wishlist-cont">
            @if ($items->count())

                @foreach ($items as $item)
                    <div>
                        @include ('shop::customers.account.wishlist.wishlist-product', [
                            'item' => $item,
                            'visibility' => $isSharingEnabled
                        ])
                    </div>
                @endforeach
{{--                <div>--}}
{{--                    {{ $items->links()  }}--}}
{{--                </div>--}}
            @else
                <div class="empty">
                    {{ __('customer::app.wishlist.empty') }}
                </div>
            @endif
    </div>

    @if($isSharingEnabled)
        <div id="shareWishlistModal" class="d-none">
            <modal id="shareWishlist" :is-open="modalIds.shareWishlist">
                <h3 slot="header">
                    {{ __('shop::app.customer.account.wishlist.share-wishlist') }}
                </h3>

                <i class="rango-close"></i>

                <div slot="body">
                    <share-component></share-component>
                </div>
            </modal>
        </div>
    @endif

    {!! view_render_event('bagisto.shop.customers.account.wishlist.list.after', ['wishlist' => $items]) !!}
@endsection

@push('scripts')
    @if($isSharingEnabled)
        <script type="text/x-template" id="share-component-template">
            <form method="POST">
                @csrf

                <div class="form-group">
                    <label class="label-style mandatory">
                        {{ __('shop::app.customer.account.wishlist.wishlist-sharing') }}
                    </label>

                    <select name="shared" class="form-control" @change="shareWishlist($event.target.value)">
                        <option value="0" :selected="! isWishlistShared">{{ __('shop::app.customer.account.wishlist.disable') }}</option>
                        <option value="1" :selected="isWishlistShared">{{ __('shop::app.customer.account.wishlist.enable') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-style mandatory">
                        {{ __('shop::app.customer.account.wishlist.visibility') }}
                    </label>

                    <div>
                        <span class="badge badge-success" v-if="isWishlistShared">
                            {{ __('shop::app.customer.account.wishlist.public') }}
                        </span>

                        <span class="badge badge-danger" v-else>
                            {{ __('shop::app.customer.account.wishlist.private') }}
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-style mandatory">
                        {{ __('shop::app.customer.account.wishlist.shared-link') }}
                    </label>

                    <div class="input-group" v-if="isWishlistShared">
                        <input
                            type="text"
                            class="form-control"
                            v-model="wishlistSharedLink"
                            v-on:focus="$event.target.select()"
                            ref="sharedLink"
                        />

                        <div class="input-group-append">
                            <button
                                class="btn btn-outline-secondary theme-btn"
                                style="padding: 6px 20px"
                                id="copy-btn"
                                title="{{ __('shop::app.customer.account.wishlist.copy-link') }}"
                                type="button"
                                @click="copyToClipboard"
                            >
                                {{ __('shop::app.customer.account.wishlist.copy') }}
                            </button>
                        </div>
                    </div>

                    <p class="alert alert-danger" v-else>
                        {{ __('shop::app.customer.account.wishlist.enable-wishlist-info') }}
                    </p>
                </div>
            </form>
        </script>

        <script>
            /**
             * Show share wishlist modal.
             */
            function showShareWishlistModal() {
                document.getElementById('shareWishlistModal').classList.remove('d-none');

                window.app.showModal('shareWishlist');
            }

            Vue.component('share-component', {
                template: '#share-component-template',

                inject: ['$validator'],

                data: function () {
                    return {
                        isWishlistShared: parseInt("{{ $isWishlistShared }}"),

                        wishlistSharedLink: "{{ $wishlistSharedLink }}".replace("&amp;", "&"),
                    }
                },

                methods: {
                    shareWishlist: function(val) {
                        var self = this;

                        this.$root.showLoader();

                        this.$http.post("{{ route('customer.wishlist.share') }}", {
                            shared: val
                        })
                        .then(function(response) {
                            self.$root.hideLoader();

                            self.isWishlistShared = response.data.isWishlistShared;

                            self.wishlistSharedLink = response.data.wishlistSharedLink;
                        })
                        .catch(function (error) {
                            self.$root.hideLoader();

                            window.location.reload();
                        })
                    },

                    copyToClipboard: function() {
                        this.$refs.sharedLink.focus();
                        document.execCommand('copy');
                        showCopyMessage();
                    }
                }
            });
        </script>
    @endif

    <script>
        /**
         * Delete all wishlist.
         */
        function deleteAllWishlist() {
            if (confirm('{{ __('shop::app.customer.account.wishlist.confirm-delete-all') }}')) document.getElementById('remove-all-wishlist').submit();

            return;
        }

        function showCopyMessage()
        {
            $('#copy-btn').text("{{ __('shop::app.customer.account.wishlist.copied') }}");
            $('#copy-btn').css({backgroundColor: '#146e24'});
        }
    </script>
@endpush