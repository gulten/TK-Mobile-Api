<?php

namespace App\Http\Requests\Device;

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
            'uid' => 'required|string|max:50',
            'appId' => 'required|string|max:50',
            'language' => 'required|string|max:20',
            'operating_system' => 'required|string|max:50'
        ];
    }
}
