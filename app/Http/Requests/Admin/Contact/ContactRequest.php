<?php

namespace App\Http\Requests\Admin\Contact;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'title.ar' => 'nullable|max:255',
            'title.en' => 'nullable|max:255',

            'description.ar' => 'nullable',
            'description.en' => 'nullable',

            
          
            'meta_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'meta_title.ar' => 'nullable|max:255',
            'meta_title.en' => 'nullable|max:255',
            'meta_description.ar' => 'nullable|max:255',
            'meta_description.en' => 'nullable|max:255',
            'meta_tags.ar' => 'nullable',
            'meta_tags.en' => 'nullable',
            'alt_text.ar' => 'nullable|max:255',
            'alt_text.en' => 'nullable|max:255',
            'address.ar' => 'required',
            'address.en' => 'required',
            'facebook' => 'required',
            'whatsapp' => 'required',
            'iniesta' => 'required',
            'tiktok' => 'nullable',
            'x' => 'nullable',
            'phono' => 'nullable',

            


            



        ];
    }
    public function messages(): array
    {
        return [
            'address.ar.required' => TranslationHelper::translate('Please Enter address in Arabic'),
            'address.en.required' => TranslationHelper::translate('Please Enter address in English'),

            'facebook.required' => TranslationHelper::translate('Please Enter facebook'),
            'whatsapp.required' => TranslationHelper::translate('Please Enter whatsapp'),
            'iniesta.required' => TranslationHelper::translate('Please Enter iniesta'),


            // 'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
            // 'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),

            'meta_image.image' => TranslationHelper::translate('Image is Not Valid'),
            'meta_image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
            'meta_title.ar.max' => TranslationHelper::translate('Meta Title in Arabic is Too Long'),
            'meta_title.en.max' => TranslationHelper::translate('Meta Title in English is Too Long'),
            'meta_description.ar.max' => TranslationHelper::translate('Meta Description in Arabic is Too Long'),
            'meta_description.en.max' => TranslationHelper::translate('Meta Description in English is Too Long'),
            'meta_tags.ar.max' => TranslationHelper::translate('Meta Tags in Arabic is Too Long'),
            'meta_tags.en.max' => TranslationHelper::translate('Meta Tags in English is Too Long'),
            'alt_text.ar.max' => TranslationHelper::translate('Alt Text in Arabic is Too Long'),
            'alt_text.en.max' => TranslationHelper::translate('Alt Text in English is Too Long'),

            'tiktok.url' => 'رابط تيك توك غير صالح.',
            'x.url' => 'رابط X غير صالح.',
        ];
    }
}
