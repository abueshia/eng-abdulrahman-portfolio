<?php

namespace App\Http\Requests\Admin\Pointssetting;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class PointssettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'invite_friend' => 'required',
            'product_code' => 'required',

            'new_registration'=> 'nullable'

        ];
    }
    public function messages(): array
    {
        return [
            'invite_friend.required' => TranslationHelper::translate('Please Enter invite_friend '),

            'product_code.required' => TranslationHelper::translate('Please Enter product_code'),
   
        ];
    }
}
