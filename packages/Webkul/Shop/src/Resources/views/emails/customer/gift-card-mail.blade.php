@component('shop::emails.layouts.master')

    <div>
        <div style="text-align: center; padding-top:60px; padding-bottom: 50px; background-color: #232427;">
            <a style="font-weight:300; text-transform: uppercase ;
            text-decoration: none; font-size:24px;
            color:white;
            font-family: Outfit, sans-serif ;
            line-height: 4px;
            letter-spacing: 3px; " href="{{ config('app.url') }}">
                Katarina Zlajić
            </a>
        </div>

        <div style="color:#232427; font-weight:500; padding-top:40px; margin-inline: 60px;">
            <div style="font-size:16px; color:#232427;">
                <b style="font-size: 19px;">Hello, {{$data['name']}}</b>
                <div style="padding-bottom: 10px;"></div>
                <p>
                    Congratulations!
                </p>
                <p>
                    You have received a Gift Card from <b>{{$data['sender']}}</b>. Here's a <u>Gift Voucher of {{$data['amount']}}€</u> you can put towards your next purchase with us.
                </p>
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
                            <b>{{ $data['message'] }}</b>
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

            <div style="font-size:16px; color:#242424; padding-bottom: 50px;">
                <a style="font-weight:300; text-transform: uppercase;
            text-decoration: none; font-size:18px;
            color:#232427;
            font-family: Outfit, sans-serif ;
            line-height: 4px;
            letter-spacing: 3px; " href="{{ config('app.url') }}">
                    Katarina Zlajić
                </a>
            </div>

        </div>

        <div style="text-align: center; padding-top:30px; padding-bottom: 30px; background-color: #232427;">
            <p style="font-weight:300; text-transform: uppercase ;
            text-decoration: none; font-size:20px;
            color:white;
            font-family: Outfit, sans-serif ;
            line-height: 3px;
            letter-spacing: 3px;">
                Happy Shopping!
            </p>
        </div>

@endcomponent