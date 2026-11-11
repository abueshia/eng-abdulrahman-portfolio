<?php

namespace App\Http\Requests\Admin\About;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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

            'description_story.ar' => 'nullable',
            'description_story.en' => 'nullable',
            'description_see_us.ar' => 'nullable',
            'description_see_us.en' => 'nullable',
            'description_our_mission.ar' => 'nullable',
            'description_our_mission.en' => 'nullable',
            'description_about_the_plan.ar' => 'nullable',
            'description_about_the_plan.en' => 'nullable',

            'image' => 'nullable',

            'meta_image' => 'nullable',

            



        ];
    }
    public function messages(): array
    {
        return [
            'title.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),
            'title.en.required' => TranslationHelper::translate('Please Enter Name in English'),
            'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
            'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),

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

        ];
    }
}
