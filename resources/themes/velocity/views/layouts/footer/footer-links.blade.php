<div class="bg-shaka-black2">
    <div class="container p-5">
        <div class="row">
            <div class="col-md-4 col-6 py-5 offset-3 offset-md-0">
                {!! file_get_contents(public_path('\images\logo.svg')) !!}
                <p class="text-shaka-subtitle my-4">Based in Montenegro</p>
                <a href="#" target="_blank"><img src="{{ asset('images/facebook-logo.svg') }}" alt=""></a>
                <a href="#" class="ml-3" target="_blank"><img src="{{ asset('images/instagram-logo.svg') }}" alt=""></a>
            </div>
            <div class="col-md-8 col-sm-12 py-md-5 py-2">
                <div class="row">
                    <div class="d-sm-block d-md-none mb-5" style="border-top: 1px solid rgba(255,255,255,0.2); width: 200%"></div>

                    <div class="col-md-4 col-6">
                        <div><a href="#" class="text-shaka-subtitle">Home</a></div>
                        <div class="mt-3"><a href="#" class="text-shaka-subtitle">Shop</a></div>
                    </div>
                    <div class="col-md-4 col-6">
                        <!-- <div><a href="#" class="text-shaka-subtitle">Behind the scenes</a></div> -->
                        <div><a href="#" class="text-shaka-subtitle">About</a></div>
                        <div class="mt-3"><a href="#" class="text-shaka-subtitle">Contact</a></div>
                    </div>
                    <div class="d-sm-block d-md-none mt-5" style="border-top: 1px solid rgba(255,255,255,0.2); width: 200%"></div>
                    <div class="col-md-4 col-12 mt-5 mt-md-0">
                        <div><a href="{{ route('shop.terms-conditions') }}" class="text-shaka-subtitle">Terms and Conditions</a></div>
                        <div class="mt-3"><a href="{{ route('shop.privacy-policy') }}" class="text-shaka-subtitle">Privacy Policy</a></div>
                        <div class="mt-3"><a href="#" class="text-shaka-subtitle">FAQ</a></div>
                        <div class="mt-3"><a href="{{ route('shop.returns') }}" class="text-shaka-subtitle">Returns</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-shaka-black2" style="border-top: 1px solid rgba(255,255,255,0.2);">
    <div class="container p-4">
        <div class="row footer-statics no-margin ">
            <div class="col-6 text-left text-white">
                © {{ date('Y') }} Katarina Zlajić

            </div>
            <div class="col-6">
                <span class="author float-right text-white">
            Made with ♡ by D.
        </span>
            </div>
        </div>
    </div>
</div>

