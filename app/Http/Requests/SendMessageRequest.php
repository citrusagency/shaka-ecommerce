<?php

namespace App\Http\Requests;

use App\Rules\ReCaptcha;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'message_body' => ['required'],
            'message_title' => ['required'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
          ];
    }
}
