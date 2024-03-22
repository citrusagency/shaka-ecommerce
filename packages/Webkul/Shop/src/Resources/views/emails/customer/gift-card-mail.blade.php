@component('shop::emails.layouts.master')

    <div style="font-family: Outfit, sans-serif !important;">
        <div style="font-size:16px; color:#232427;">
            <b style="font-size: 19px;">Hello, {{$data['name']}}</b>
            <div style="padding-bottom: 10px;"></div>
            <p>
                Congratulations!
            </p>
            <p>
                You have received a Gift Card from <b>{{$data['sender']}}</b>. Here's a <u>Gift Voucher of {{$data['amount']}}€</u> you can put towards your next purchase with us.
                Use the coupon code below when checking out your selected products:
            </p>
        </div>

        <div style="text-align: center; padding-top: 20px; padding-bottom: 10px; color:#69696a;">
            <p style="padding-bottom: 5px; display: inline-block; font-size:20px!important;">{{$data['code']}}</p>
        </div>

        <div style="padding-top:30px;"></div>
        <hr style="border-radius: 50%; border: 2px double rgba(36,36,36,0.79);"/>
        <div style="padding-top:20px;"></div>

        <table style="width: 100%; border-collapse: collapse; font-size:16px; color:#232427; text-align: left; ">
            <tbody>
                <tr>
                    <th style="width: 10%;"></th>
                    <th style="width: 40%;">
                        <img style="max-width: 100%; align-self: center" src="{{asset('/images/gift_card.png')}}" alt="Gift Card photo"/>
                    </th>
                    <th style="width: 40%; padding-inline: 50px;">
                        <i>{{ $data['message']!='' ? $data['message'].',' : 'Best wishes,'}}</i>
                        <br/><br/>
                        <i style="text-align: right;">{{ $data['sender']}}</i>
                    </th>
                    <th style="width: 10%;"></th>
                </tr>
            </tbody>
        </table>

        <div style="padding-top:30px;"></div>
        <hr style="border-radius: 50%; border: 2px double rgba(36,36,36,0.79);"/>
        <div style="padding-top:20px;"></div>

        <div style="font-size:16px; color:#232427;">
            <p>Please feel free to contact us with any questions.</p>
            <p>Best regards,</p>
        </div>
    </div>

@endcomponent