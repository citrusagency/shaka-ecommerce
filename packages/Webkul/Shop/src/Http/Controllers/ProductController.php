<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Webkul\CartRule\Repositories\CartRuleCouponRepository;
use Webkul\Product\Http\Requests\GiftCardRequest;
use Webkul\Product\Repositories\ProductAttributeValueRepository;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Mail\GiftCardEmail;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Product\Repositories\ProductAttributeValueRepository  $productAttributeValueRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableSampleRepository  $productDownloadableSampleRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableLinkRepository  $productDownloadableLinkRepository
     * @return void
     */
    public function __construct(
        protected ProductAttributeValueRepository $productAttributeValueRepository,
        protected ProductDownloadableSampleRepository $productDownloadableSampleRepository,
        protected ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        protected ProductRepository $productRepository,
    )
    {
        parent::__construct();
    }

    /**
     * Download image or file.
     *
     * @param  int  $productId
     * @param  int  $attributeId
     * @return \Illuminate\Http\Response
     */
    public function download($productId, $attributeId)
    {
        $productAttribute = $this->productAttributeValueRepository->findOneWhere([
            'product_id'   => $productId,
            'attribute_id' => $attributeId,
        ]);

        return isset($productAttribute['text_value'])
            ? Storage::download($productAttribute['text_value'])
            : null;
    }

    public function getAll(Request $request)
    {

        $product = $this->productRepository->getAll();
            return view('shop::products.index', compact('product'));
    }

    /**
     * Download the for the specified resource.
     *
     * @return \Illuminate\Http\Response|\Exception
     */
    public function downloadSample()
    {
        try {
            if (request('type') == 'link') {
                $productDownloadableLink = $this->productDownloadableLinkRepository->findOrFail(request('id'));

                if ($productDownloadableLink->sample_type == 'file') {
                    $privateDisk = Storage::disk('private');

                    return $privateDisk->exists($productDownloadableLink->sample_file)
                        ? $privateDisk->download($productDownloadableLink->sample_file)
                        : abort(404);
                } else {
                    $fileName = substr($productDownloadableLink->sample_url, strrpos($productDownloadableLink->sample_url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableLink->sample_url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            } else {
                $productDownloadableSample = $this->productDownloadableSampleRepository->findOrFail(request('id'));

                if ($productDownloadableSample->type == 'file') {
                    return Storage::download($productDownloadableSample->file);
                } else {
                    $fileName = substr($productDownloadableSample->url, strrpos($productDownloadableSample->url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableSample->url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function getGiftCardView()
    {
        if (! auth()->guard('customer')->check()) {
            return redirect()->route('customer.session.index');
        }
        return view('shop::products.gift-card');
    }

    public function sendGiftCard(GiftCardRequest $request)
    {
        $data = $request->only(['recipient-name', 'recipient-email', 'sender-name', 'amount', 'message']);
        //$deliveryDate = Carbon::parse($request->get('delivery-date'));

        $couponData = [
            'coupon_qty'=>1,
            'code_length'=>14,
            'code_format'=>'alphanumeric',
            'code_prefix'=>'',
            'code_suffix'=>''
        ];

        try {
            if ($data) {
                session()->flash('success', trans('contact_lang::app.response.message-send-success'));
                try {
                    $couponCode = CartRuleCouponRepository::generateCoupon($couponData, $data['amount']);
                    $data['couponCode']=$couponCode;

                    Mail::queue(new GiftCardEmail($data));
                } catch (\Exception $e) {
                    Log::error(
                        'prepareMail' . $e->getMessage()
                    );
                }
                return redirect()->route('shop.giftCard');
            }
        } catch (\Exception $e) {
            dd("Gift Card email exception: ", $e);
        }
    }

}
