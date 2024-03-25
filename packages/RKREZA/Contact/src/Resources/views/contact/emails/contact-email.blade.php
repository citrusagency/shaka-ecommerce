@component('shop::emails.layouts.master')

    <div class="p-text w-pd" style="font-size: 19px !important;">
        You have a new message:
    </div>
    <div class="message-container">
        <div class="p-text">
            <b>Name: </b>
            <span>{{ $data['name'] }}</span>
        </div>
        <div class="p-text">
           <b>Email: </b>
            <span>{{ $data['email'] }}</span>
        </div>
        <div class="p-text">
            <b>Subject: </b>
            <span>{{ $data['subject'] }}</span>
        </div>
        <div class="p-text">
            <b>Message: </b>
            <span>{{ $data['message_body'] }}</span>
        </div>
    </div>


@endcomponent