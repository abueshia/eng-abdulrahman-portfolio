<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Blog;

use App\Helpers\TranslationHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name.ar' => 'required|max:255',
            'name.en' => 'required|max:255',
            'description.ar' => 'required',
            'description.en' => 'required',
            'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp|nullable',

            // 'category_id'=>'required',
            // 'meta_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            // 'meta_description' => 'nullable|string|max:160',
            // 'meta_title' => 'nullable|string|max:255',
            // 'alt_text' => 'nullable|string|max:255',
            // 'meta_tags' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Name'),
            'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
            'description.string' => TranslationHelper::translate('Description must be a string'),
            // 'category_id.required' => TranslationHelper::translate('Please Choose Category'),
            // 'meta_image.image' => TranslationHelper::translate('Meta Image is Not Valid'),
            // 'meta_image.mimes' => TranslationHelper::translate('Meta Image Type is Not Valid'),
            // 'meta_description.string' => TranslationHelper::translate('Meta Description must be a string'),
            // 'meta_description.max' => TranslationHelper::translate('Meta Description must not be greater than 160 characters'),
            // 'meta_title.string' => TranslationHelper::translate('Meta Title must be a string'),
            // 'meta_title.max' => TranslationHelper::translate('Meta Title must not be greater than 255 characters'),
            // 'alt_text.string' => TranslationHelper::translate('Alt Text must be a string'),
            // 'alt_text.max' => TranslationHelper::translate('Alt Text must not be greater than 255 characters'),
            // 'meta_tags.array' => TranslationHelper::translate('Meta Tags must be an array'),
        ];
    }
}
