<div class="bg-shaka-black2">
    <div class="footer-con">
        <div class="footer-flex">
            <div class="col footer-col">
                {!! file_get_contents(public_path('/images/logo.svg')) !!}
                <p class="text-shaka-subtitle my-4">Based in Montenegro</p>
                <div>
                    <a href="https://www.instagram.com/katarinazlajic/?hl=en" class="ml-3" target="_blank"><img style="height: 25px !important;" src="{{ asset('images/instagram-logo.svg') }}" alt=""></a>
                    <a href="https://www.facebook.com/katarinazlajicaccessories/?locale=sr_RS" class="ml-5" target="_blank"><img style="height: 25px !important;" src="{{ asset('images/facebook-logo.svg') }}" alt=""></a>
                </div>
            </div>
            <hr style="height:1px; background-color:rgba(218,218,218,0.3); margin:30px 0; border-radius: 40%;"/>
            <div class="col">
                <div class="row justify-content-between">
                    <div class="col">
                        <div><a href="{{route('shop.home.index')}}" class="footer-links footer-text">Home</a></div>
                        <div class="mt-3"><a href="{{route('shop.getAllProducts')}}" class="footer-links footer-text">Shop</a></div>
                        <div class="mt-3"><a href="{{route('shop.about')}}" class="footer-links footer-text">About</a></div>
                        <div class="mt-3"><a href="{{route('shop.contact.index')}}" class="footer-links footer-text">Contact</a></div>
                    </div>
                    <div class="col">
                        <div><a href="{{ route('shop.terms-conditions') }}"  class="footer-links footer-text">Terms and Conditions</a></div>
                        <div class="mt-3"><a href="{{ route('shop.privacy-policy') }}"  class="footer-links footer-text">Privacy Policy</a></div>
                        <div class="mt-3"><a href="{{ route('shop.returns') }}"  class="footer-links footer-text">Returns</a></div>
                    </div>
                </div>
            </div>
        </div>
        <hr style="height:1px; background-color:rgba(218,218,218,0.3); margin:30px 0; border-radius: 40%;"/>
        <div class="row no-margin">
            <div class="col-6 text-left footer-text text-shaka-subtitle">
                Katarina Zlajić, {{ date('Y') }}
            </div>
            <div class="col-6">
                <span class="float-right made-by footer-text text-shaka-subtitle">
                    Made by <a href="https://www.citrus.codes/" target="_blank" class="citrus-codes footer-text">Citrus Codes</a>
                </span>
            </div>
        </div>
    </div>
</div>


