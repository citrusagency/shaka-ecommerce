<?php

namespace Webkul\Notify\Listeners;

use Illuminate\Support\Facades\Log;
use Webkul\Notify\Repository\NotifyRepository;
use Illuminate\Support\Facades\Mail;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Notify\Mail\ProductBackInStockNotification;
use Webkul\Product\Repositories\ProductRepository;

class ProductUpdateAfterListener
{
    /**
     * Create a controller instance.
     *
     * @param  \Webkul\Notify\Repository\NotifyRepository  $notifyRepository
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param   \Webkul\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(
        protected NotifyRepository   $notifyRepository,
        protected CustomerRepository $customerRepository,
        protected ProductRepository  $productRepository
    )
    {
    }

    /**
     * Handle the event.
     *
     * @param  mixed  $product
     * @return void
     */
    public function handle($product)
    {
        try {
            $datas = $this->notifyRepository->findByField('product_id', $product->id);
            foreach ($datas as $data) {
                $customer_email = $data->customer_email;
                Mail::queue(new ProductBackInStockNotification($product, $customer_email));
                $this->notifyRepository->delete($data->id);
                session()->flash('success', 'Customers are notified about updated product.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to notify customers about product restock.');
            Log::error('Error: ' . $e->getMessage());
        }

    }
}