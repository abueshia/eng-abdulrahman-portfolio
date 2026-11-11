<?php

namespace App\Http\Requests\Admin\Setting;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class UseTermsRequest extends FormRequest
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
            'use_terms.*' => 'required',
            ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function messages(): array
    {
        return [
            'required' => TranslationHelper::translate('This Field is Required'),
            ];
    }
}
