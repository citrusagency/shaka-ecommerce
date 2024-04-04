<div style="margin-top: 20px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">
    @if(isset($test) && $test)
        <p class="p-text">
            {{ __('shop::app.mail.'.$text) }}
        </p>
    @endif
    <p class="p-text">
        {!!
            __('shop::app.mail.order.help', [
                'support_email' => '<a class="admin-email" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'
                ])
        !!}
    </p>
    <p class="p-text">
        {{ __('shop::app.mail.order.thanks') }}
    </p>
</div>