<?php

namespace App\Http\Requests\Admin\Place;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'title.ar' => 'required|max:255',
            'title.en' => 'required|max:255',
            'placecat_id' => 'required|exists:placecats,id',

            // 'description.ar' => 'required|string|max:255',
            // 'description.en' => 'required|string|max:255',

            // 'meta_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            // 'meta_title.ar' => 'nullable|max:255',
            // 'meta_title.en' => 'nullable|max:255',
            // 'meta_description.ar' => 'nullable|max:255',
            // 'meta_description.en' => 'nullable|max:255',
            // 'meta_tags.ar' => 'nullable',
            // 'meta_tags.en' => 'nullable',
            // 'alt_text.ar' => 'nullable|max:255',
            // 'alt_text.en' => 'nullable|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp',

        ];
    }
    public function messages(): array
    {
        return [
            'title.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),
            'title.en.required' => TranslationHelper::translate('Please Enter Name in English'),

            'placecat_id.required' => TranslationHelper::translate('Please Choose city'),
            'placecat_id.exists' => TranslationHelper::translate('city Doesn\'t Exists'),
            
            // 'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
            // 'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),

            // 'slug.required' => TranslationHelper::translate('Please Enter Slug'),
            // 'slug.alpha_dash' => TranslationHelper::translate('Slug must be only letters, numbers, and dashes'),
            // 'slug.unique' => TranslationHelper::translate('Slug is already taken'),

            // 'meta_image.image' => TranslationHelper::translate('Image is Not Valid'),
            // 'meta_image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
            // 'meta_title.ar.max' => TranslationHelper::translate('Meta Title in Arabic is Too Long'),
            // 'meta_title.en.max' => TranslationHelper::translate('Meta Title in English is Too Long'),
            // 'meta_description.ar.max' => TranslationHelper::translate('Meta Description in Arabic is Too Long'),
            // 'meta_description.en.max' => TranslationHelper::translate('Meta Description in English is Too Long'),
            // 'meta_tags.ar.max' => TranslationHelper::translate('Meta Tags in Arabic is Too Long'),
            // 'meta_tags.en.max' => TranslationHelper::translate('Meta Tags in English is Too Long'),
            // 'alt_text.ar.max' => TranslationHelper::translate('Alt Text in Arabic is Too Long'),
            // 'alt_text.en.max' => TranslationHelper::translate('Alt Text in English is Too Long'),
            
            'image.required' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),

        ];
    }
}

