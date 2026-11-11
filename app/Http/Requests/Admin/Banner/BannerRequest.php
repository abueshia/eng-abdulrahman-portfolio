<?php

namespace App\Http\Requests\Admin\Banner;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'before_image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp',
            'after_image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'يرجى إدخال عنوان الحالة',
            'description.required' => 'يرجى إدخال وصف الحالة',
            'before_image.required_without' => 'يرجى رفع صورة قبل العلاج',
            'after_image.required_without' => 'يرجى رفع صورة بعد العلاج',
            'before_image.image' => TranslationHelper::translate('Image is Not Valid'),
            'after_image.image' => TranslationHelper::translate('Image is Not Valid'),
        ];
    }
}
