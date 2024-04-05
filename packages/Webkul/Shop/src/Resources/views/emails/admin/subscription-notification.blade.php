@component('shop::emails.layouts.master')

    <p class="p-text">
        {{ $data['content'] }}
    </p>

    <p class="p-text" style="margin-bottom: 40px;">
        {{ $data['email'] }}
    </p>

@endcomponent