<?php

namespace Webkul\Shop\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GiftCardEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a mailable instance
     *
     * @param  array  $dataReceived
     */
    public function __construct(public $dataReceived){
    }

//    public function build(){
//        $this->from(env('MAIL_FROM_ADDRESS'));
//        $this->subject('Gift Card');
//
//        return $this->view('contact_view::contact.emails.contact-email')
//            ->with('data', [
//            'subject' => 'title',
//            'email'  => 'title',
//            'name'  => 'title',
//            'message_body'  => 'title',
//        ]);
//    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->dataReceived['amount']);
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->dataReceived['recipient-email'])
            ->subject("KZ | Gift Card")
            ->view('shop::emails.customer.gift-card-mail')
            ->with('data', [
                'name' => $this->dataReceived['recipient-name'],
                'sender'  => $this->dataReceived['sender-name'],
                'amount'  => $this->dataReceived['amount'],
                'message' => $this->dataReceived['message']
            ]);
    }
}