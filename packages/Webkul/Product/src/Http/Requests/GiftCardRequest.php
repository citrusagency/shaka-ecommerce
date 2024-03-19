<?php

namespace Webkul\Product\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Webkul\Core\Contracts\Validations\Slug;
use Webkul\Core\Contracts\Validations\Decimal;
use Webkul\Product\Models\ProductAttributeValue;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Admin\Validations\ProductCategoryUniqueSlug;
use Webkul\Product\Repositories\ProductAttributeValueRepository;

class GiftCardRequest extends FormRequest
{
    /**
     * Rules.
     *
     * @var array
     */
    protected $rules;

    /**
     * Create a new form request instance.
     *
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @param  \Webkul\Product\Repositories\ProductAttributeValueRepository  $productAttributeValueRepository
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the product is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recipient-name' =>['required', 'string', 'max:200', 'min:2'],
            'recipient-email'=>['required', 'email'],
            'sender-name'=>['required', 'string', 'max:200', 'min:2'],
            'amount'=>['required'],
            'delivery-date'=>['required','date','after:now'],
            'message'=>['nullable', 'max:200']
        ];
    }

    /**
     * Custom message for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'recipient-name.required' => 'Recipient name is required',
            'recipient-name.string' => 'Recipient name must be a string',
            'recipient-name.max' => 'Recipient name must be maximum 200 characters',
            'recipient-name.min' => 'Recipient name must be minimum 2 characters',
            'recipient-email.required' => 'Recipient email is required',
            'recipient-email.email' => 'Enter valid email address',
            'sender-name.required' => 'Sender name is required',
            'sender-name.string' => 'Sender name must be a string',
            'sender-name.max' => 'Sender name must be maximum 200 characters',
            'sender-name.min' => 'Sender name must be minimum 2 characters',
            'amount.required' => 'Select an amount',
            'delivery-date.required' => 'Delivery date is required',
            'delivery-date.date' => 'Enter valid date',
            'delivery-date.after' => 'Delivery date must be a future date',
            'message-date.max' => 'Maximum of characters for message is 200',
//            'recipient-name.required' => __('admin::app.response.already-taken', ['name' => ':attribute']),
        ];
    }

}
