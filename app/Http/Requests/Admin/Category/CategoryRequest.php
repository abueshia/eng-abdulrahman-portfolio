<?php

namespace App\Http\Requests\Admin\Category;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name.ar' => 'required|max:255',
            'name.en' => 'required|max:255',
            // 'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp|nullable',
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
            // 'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            // 'image.image' => TranslationHelper::translate('Image is Not Valid'),
            // 'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
        ];
    }
}
