<?php

namespace Webkul\Notify\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductBackInStockNotification extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new mailable instance.
     *
     * @return void
     */
    public function __construct(public $product, public $customer_email)
    {
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->customer_email)
            ->subject('Product Back In Stock Notification')
            ->view('notify::emails.product_back_in_stock_notification')
            ->with([
                'product_name'=>$this->product->name,
            ]);
    }
}