<div class="profile-sidebar">
    <div class="sidebar-name">
        <p>Hi, </p>
        <p class="profile-name">
            {{ auth('customer')->user()->first_name . ' ' . auth('customer')->user()->last_name}}
        </p>
    </div>

    @foreach ($menu->items as $menuItem)
        <ul type="none" class="navigation" style="width: 100%;" >
            {{-- rearrange menu items --}}
            @php
                $subMenuCollection = [];

                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;

                try {
                    $subMenuCollection['profile'] = $menuItem['children']['profile'];
                    $subMenuCollection['orders'] = $menuItem['children']['orders'];

                    if ($showWishlist) {
                        $subMenuCollection['wishlist'] = $menuItem['children']['wishlist'];
                    }

                    $subMenuCollection['address'] = $menuItem['children']['address'];

                    unset(
                        $menuItem['children']['profile'],
                        $menuItem['children']['orders'],
                        $menuItem['children']['wishlist'],
                        $menuItem['children']['address']
                    );

                    foreach ($menuItem['children'] as $key => $remainingChildren) {
                        $subMenuCollection[$key] = $remainingChildren;
                    }
                } catch (\Exception $exception) {
                    $subMenuCollection = $menuItem['children'];
                }
            @endphp

            @foreach ($subMenuCollection as $index => $subMenuItem)
                <li title="{{$index,  trans($subMenuItem['name']) }}">
                    <a class="sidebar-items" id="sidebar{{$index}}" href="{{ $subMenuItem['url'] }}">
                        {!! file_get_contents(public_path('images/' . $subMenuItem['icon'] . '.svg')) !!}
                        <span style="width: 65%;">{{ trans($subMenuItem['name']) }}</span>
                        <i class="rango-arrow-right float-right text-down-3"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>

@push('scripts')
    <script type="text/javascript">
        window.addEventListener('load', function() {
            const path = window.location.pathname.split('/')[3];
            const linkToSelect = document.getElementsByClassName("sidebar-items");
            const linkArray = Array.from(linkToSelect);

            linkArray.forEach(link => {
                if(link["href"].split('/')[5]===path){
                    link.classList.add('selected-link');
                }
            });
        });
    </script>
@endpush