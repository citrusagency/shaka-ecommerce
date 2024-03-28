<?php

namespace RKREZA\Contact\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a mailable instance
     *
     * @param  array  $contactData
     */
    public function __construct(public $contactData)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to(core()->getAdminEmailDetails()['email'], core()->getAdminEmailDetails()['name'])
            ->subject(__('contact_lang::app.contact.title'))
            ->view('contact_view::contact.emails.contact-email')
            ->with('data', [
                'subject' => $this->contactData['message_title'],
                'email'  => $this->contactData['email'],
                'name'  => $this->contactData['name'],
                'message_body'  => $this->contactData['message_body'],
            ]);
    }
}