<?php

namespace Webkul\Shop\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a mailable instance
     *
     * @param  array  $subscriptionData
     */
    public function __construct(public $subscriptionData)
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
            ->to(core()->getAdminEmailDetails()['email'])
            ->subject(trans('shop::app.mail.customer.subscription.subject'))
            ->view('shop::emails.admin.subscription-notification')
            ->with('data', [
                'content' => 'You have a new subscriber: ',
                'email'   => $this->subscriptionData['email']
            ]);
    }
}