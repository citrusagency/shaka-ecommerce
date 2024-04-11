@push('css')
    <style type="text/css">
        .notify-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .notify-modal-content {
            background-color: #fefefe;
            margin: 300px auto;
            padding: 40px  60px !important;
            border: 1px solid #888;
            border-radius: 10px;
            width: 700px;
        }

        /* Close Button */
        .close-btn {
            color: #777;
            float: right;
            font-size: 28px;
            font-weight: 500;
            border:none;
            width:30px;
            height: 30px;
            margin: 0 !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #1197C2;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-stl2{
            padding: 8px 22px;
            border-radius: 0 8px 8px 0 !important;
            background: #1197C2;
            letter-spacing: 0.48px;
            height: 50px !important;
        }

        .input-stl2{
            border-radius: 8px 0 0 8px;
            border:1px solid #DADADA !important;
            color: #777;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 100%;
            letter-spacing: 0.28px;
            padding: 16px !important;
            height: 50px !important;
        }

        .input_error{
            border:1px solid #f65757 !important;
        }

        @media only screen and (max-width: 1220px) {
            .modal-content{
                padding: 20px  30px !important;
                width: 70%;
            }
        }


        @media only screen and (max-width: 480px) {
            .modal-content{
                padding: 20px  30px !important;
                width: 96%;
            }
            .notify-available{
                padding:10px !important;
            }
        }

    </style>
@endpush

{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}


        <div class="add-to-cart-btn pl0">
            @if (
                isset($form)
                && ! $form
            )
                @if($product->isSaleable())
                    <button
                        type="submit"
                        {{ ! $product->isSaleable() ? 'disabled' : '' }}
                        class="theme-btn {{ $addToCartBtnClass ?? '' }}">

                        @if (
                            ! (isset($showCartIcon)
                            && ! $showCartIcon)
                        )
                            {{--                        <i class="material-icons text-down-3">shopping_cart</i>--}}
                        @endif

                        {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') :  __('shop::app.products.add-to-cart') }}
                    </button>
                @else
                    <button class="notify-available d-flex" onclick="openNotifyModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.9 16.4 5.4 13.5 4.7V4C13.5 3.2 12.8 2.5 12 2.5C11.2 2.5 10.5 3.2 10.5 4V4.7C7.6 5.4 6 7.9 6 11V16L4 18V19H20V18L18 16ZM16 17H8V11C8 8.5 9.5 6.5 12 6.5C14.5 6.5 16 8.5 16 11V17Z" fill="#fff"/>
                        </svg>
                        <p>Notify when available</p>
                    </button>
                @endif
            @elseif(isset($addToCartForm) && ! $addToCartForm)
                <form
                    method="POST"
                    action="{{ route('cart.add', $product->product_id) }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="quantity" value="1">
                    @if($product->isSaleable())
                        <button
                            type="submit"
                            {{ ! $product->isSaleable() ? 'disabled' : '' }}
                            class="btn btn-add-to-cart {{ $addToCartBtnClass ?? '' }}">

                            @if (
                                ! (isset($showCartIcon)
                                && ! $showCartIcon)
                            )
                                {{--                            <i class="material-icons text-down-3">shopping_cart</i>--}}
                            @endif

                            <span class="fs14 fw6 text-uppercase text-up-4">
                            {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}
                        </span>
                        </button>
                    @else
                        <button class="notify-available d-flex" onclick="openNotifyModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.9 16.4 5.4 13.5 4.7V4C13.5 3.2 12.8 2.5 12 2.5C11.2 2.5 10.5 3.2 10.5 4V4.7C7.6 5.4 6 7.9 6 11V16L4 18V19H20V18L18 16ZM16 17H8V11C8 8.5 9.5 6.5 12 6.5C14.5 6.5 16 8.5 16 11V17Z" fill="#fff"/>
                            </svg>
                            <p>Notify when available</p>
                        </button>
                    @endif
                </form>
            @else
                @if($product->isSaleable())
                    <add-to-cart
                        form="true"
                        csrf-token='{{ csrf_token() }}'
                        product-flat-id="{{ $product->id }}"
                        product-id="{{ $product->product_id }}"
                        reload-page="{{ $reloadPage ?? false }}"
                        move-to-cart="{{ $moveToCart ?? false }}"
                        wishlist-move-route="{{ $wishlistMoveRoute ?? false }}"
                        add-class-to-btn="{{ $addToCartBtnClass ?? '' }}"
                        is-enable={{ ! $product->isSaleable() ? 'false' : 'true' }}
                    show-cart-icon={{ ! (isset($showCartIcon) && ! $showCartIcon) }}
                    btn-text="{{ (! isset($moveToCart) && $product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}">
                    </add-to-cart>
                @else
                    <button class="notify-available d-flex" onclick="openNotifyModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.9 16.4 5.4 13.5 4.7V4C13.5 3.2 12.8 2.5 12 2.5C11.2 2.5 10.5 3.2 10.5 4V4.7C7.6 5.4 6 7.9 6 11V16L4 18V19H20V18L18 16ZM16 17H8V11C8 8.5 9.5 6.5 12 6.5C14.5 6.5 16 8.5 16 11V17Z" fill="#fff"/>
                        </svg>
                        <p>Notify when available</p>
                    </button>
                @endif
            @endif

                <div id="notifyModal" class="notify-modal">
                    <div class="notify-modal-content">
                        <div class="d-flex justify-content-between">
                            <h2 id="modal-title" style="text-transform: none; font-weight: 600; padding-bottom: 10px;">Notify me when available</h2>
                            <span class="close-btn" onclick="closeNotifyModal()">
                                {!! file_get_contents(public_path('/images/close-btn.svg')) !!}
                            </span>
                        </div>
                        <p style="color:#777; padding-bottom: 30px;">Glad you like this item! Write down your email address to get notified when it’s available again.</p>
                        <div class="w-100 subscribe d-flex">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="email" name="customerEmail" id="customerEmail" class="w-100 input-stl2" placeholder="Your email address" value="{{ $customer->email ?? '' }}"{{ auth()->check() ? ' readonly' : '' }}>
                            <button id="submitButton" onclick="sendMail({{ $product->id }})" class="btn bg-shaka-primary btn-stl2 bnt-shaka-primary d-flex justify-content-center" style="text-transform: none; width:200px;">Notify me</button>
                        </div>
                    </div>
                </div>

                <div id="successModal" class="notify-modal">
                    <div class="notify-modal-content">
                        <div class="d-flex justify-content-end">
                            <span class="close-btn" onclick="closeSuccessModal()">
                                {!! file_get_contents(public_path('/images/close-btn.svg')) !!}
                            </span>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h2 id="successModalTitle" style="text-transform: none; font-weight: 600; padding-bottom: 10px;">E-mail submitted!</h2>
                            <p style="color:#777; padding-bottom: 30px;">We will let you know as soon as the item is back in stock.</p>
                        </div>
                    </div>
                </div>
        </div>

@push('scripts')
    <script>
        function openNotifyModal() {
            let modal = document.getElementById('notifyModal');
            modal.style.display = "block";
        }

        function openSuccessModal(message) {
            let modal = document.getElementById('successModal');
            modal.style.display = "block";
            let modalTitle = document.getElementById('successModalTitle');
            modalTitle.textContent = message;
        }

        function closeNotifyModal() {
            let modal = document.getElementById('notifyModal');
            modal.style.display = "none";
        }

        function closeSuccessModal() {
            let modal = document.getElementById('successModal');
            modal.style.display = "none";
        }

        function enterEmailMessage(message) {
            let modalTitle = document.getElementById('modal-title');
            let inputField = document.getElementById('customerEmail');
            modalTitle.textContent = message;
            inputField.classList.add("input_error");
            clearInputField();
        }

        function clearInputField(){
            let inputField = document.getElementById('customerEmail');
            inputField.value = '';
        }

        function sendMail(productId) {
            let customerEmail = document.getElementById('customerEmail').value;
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(customerEmail === ''){
                enterEmailMessage('Please enter valid email or sign in!');
            }else if (!emailRegex.test(customerEmail)) {
                enterEmailMessage('Please enter valid email or sign in!');
            }else {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("shop.notify.store") }}',
                    data: {
                        product_id: productId,
                        customer_email: customerEmail,
                    },
                    success: function(response) {
                        closeNotifyModal();
                        openSuccessModal('E-mail submitted.');
                        clearInputField();
                    },
                    error: function(error) {
                        closeNotifyModal();
                        openSuccessModal('E-mail is already submitted!');
                        clearInputField();
                    }
                });
            }
            return false;
        }
    </script>
@endpush

{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}