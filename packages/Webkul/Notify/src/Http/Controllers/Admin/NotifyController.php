<?php

namespace Webkul\Notify\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Notify\DataGrids\NotifyDataGrid;
use Webkul\Notify\Http\Controllers\Controller;
use Webkul\Notify\Mail\ProductBackInStockNotification;
use Webkul\Notify\Repository\NotifyRepository;
use Webkul\Product\Repositories\ProductRepository;

class NotifyController extends Controller
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
     * Index.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(NotifyDataGrid::class)->toJson();
        }

        return view('notify::admin.index');
    }

    /**
     * Store.
     *
     */
    public function updateStockStatus(Request $request)
    {
        $notificationId = $request->notificationId;

        try {
            $data = $this->notifyRepository->find($notificationId);

            $customer = $this->customerRepository->find($data->customer_email) ?? $data->customer_email;

            $product = $this->productRepository->find($data->product_id);

            Mail::queue(new ProductBackInStockNotification($product, $customer));

            $this->notifyRepository->delete($notificationId);
            session()->flash('success', 'Stock status updated successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to send notification to customer.');
            return redirect()->back();
        }
    }
}