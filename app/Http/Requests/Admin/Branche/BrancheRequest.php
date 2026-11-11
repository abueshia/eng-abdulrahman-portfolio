<?php

namespace App\Http\Requests\Admin\Branche;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class BrancheRequest extends FormRequest
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
            'name.*' => 'required|max:255',
            'address.*' => 'required|string|max:255',
            'phone' => 'required',
            'google_map' => 'required',
            'image' => 'required',
            
           
        ];
    }
    public function messages(): array
    {
        return [
            'name.en.required' => TranslationHelper::translate('Please Enter Name in English'),
            'name.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),

            'address.en.required' => TranslationHelper::translate('Please Enter address in English'),
            'address.ar.required' => TranslationHelper::translate('Please Enter address in Arabic'),

            'phone.required' => TranslationHelper::translate('Please Enter phone in English'),

            'google_map.required' => TranslationHelper::translate('Please Enter google_map in English'),

            'image.required' => TranslationHelper::translate('Please Enter image'),


        


        ];
    }
}
