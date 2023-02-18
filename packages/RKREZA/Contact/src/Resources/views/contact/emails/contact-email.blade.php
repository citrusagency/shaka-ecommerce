@component('shop::emails.layouts.master')

    <div>
        <div style="text-align: center;">
            <a href="{{ config('app.url') }}">
                @include ('shop::emails.layouts.logo')
            </a>
        </div>

        <div style="font-size:20px; color:#242424; font-weight:600; margin-bottom: 15px">
            You have a new message
        </div>

        <div>
            <div style="font-size:16px; color:#242424;">
                <b>Name: </b>
                <p>{{ $data['name'] }}
                </p>
            </div>

            <div style="font-size:16px; color:#242424;">
               <b>Email: </b>
                <p>
                   {{ $data['email'] }}
               </p>
            </div>


            <div style="font-size:16px; color:#242424;">
                <b>Subject: </b>
                <p>{{ $data['subject'] }}
                </p>
            </div>

            <div style="font-size:16px; color:#242424;">
                <b>Message: </b>
                <p>{{ $data['message_body'] }}
                </p>
            </div>

        </div>

@endcomponent