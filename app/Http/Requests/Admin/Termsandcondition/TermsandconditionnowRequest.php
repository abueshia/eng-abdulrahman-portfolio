<?php

namespace App\Http\Requests\Admin\Termsandcondition;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class TermsandconditionnowRequest extends FormRequest
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
            'description.*' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),
            'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
        ];
    }
}
