<?php

namespace App\Http\Requests\Admin\Informationflight;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class InformationflightRequest extends FormRequest
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
            'meta_title' => 'nullable',
            'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp',
            'linke' => 'required|url',

        ];
    }
    public function messages(): array
    {
        return [
            'name.en.required' => TranslationHelper::translate('Please Enter Name in English'),
            'name.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),

            'meta_title.en.required' => TranslationHelper::translate('Please Enter meta_title in English'),
            'meta_title.ar.required' => TranslationHelper::translate('Please Enter meta_title in Arabic'),

            'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),

            'linke.required' => TranslationHelper::translate('This Field is Required'),
            'linke.url' => TranslationHelper::translate('The Link is Not Valid'),

        ];
    }
}
