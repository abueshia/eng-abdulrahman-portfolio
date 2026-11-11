<?php

namespace App\Http\Requests\Admin\Testimonial;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            // 'name' => 'required|max:255',
            // 'description' => 'required|string',
            // 'image' => 'required|image|mimes:png,jpg,jpeg,webp',
            // 'name_job' => 'required|string|max:255',

            'name.*' => 'required|max:255',
            'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp',
            'description.*' => 'required|string|max:255',
            'name_job.*' => 'required|string|max:255',
            'meta_title' => 'nullable',

        ];
    }
    public function messages(): array
    {
        return [
            'name.en.required' => TranslationHelper::translate('Please Enter Name in English'),
            'name.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),

            'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),

            'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),
            'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
            'name_job.en.required' => TranslationHelper::translate('Please Enter Name Job in English'),
            'name_job.ar.required' => TranslationHelper::translate('Please Enter Name Job in Arabic'),


            'meta_title.en' => TranslationHelper::translate('Please Enter meta_title in English'),
            'meta_title.ar' => TranslationHelper::translate('Please Enter meta_title in Arabic'),


        ];
    }
}
