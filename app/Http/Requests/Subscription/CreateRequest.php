<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'client_token' => 'bail|required|string|max:128',
            'receipt' => 'bail|required|string',
            'service' => 'required|string|in:google,ios',
            'third_party_url' => 'required|string|url',
        ];
    }
}
