<?php

namespace App\Http\Requests\Admin\Categorygallery;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class CategorygalleryRequest extends FormRequest
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
            'name' => 'required|max:255',

            'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp|nullable',

            'meta_title' => 'nullable',
          

           
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Name'),

            'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),

            'meta_title.en' => TranslationHelper::translate('Please Enter meta_title in English'),
            'meta_title.ar' => TranslationHelper::translate('Please Enter meta_title in Arabic'),
        ];
    }
}
