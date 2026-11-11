<?php

namespace App\Http\Requests\Admin\Offer;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
             // 'image' => 'required|image|mimes:png,jpg,jpeg,webp,png,jpg ',
            'image' => $this->isUpdateRequest() ? 'nullable|image|mimes:png,jpg,jpeg,webp' : 'required|image|mimes:png,jpg,jpeg,webp',
            'description' => 'required',
            'point' => 'required',
            // 'discount' => 'required',
            'products' => 'required', // قائمة المنتجات المحددة
            'branches' => 'required|array', // قائمة الفروع المحددة
            
            'discount_number'=> 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.*.required' => __('validation.required', ['attribute' => __('Offer Name')]),
            'name.*.max' => __('validation.max.string', ['attribute' => __('Offer Name'), 'max' => 255]),

            'image.required' => __('validation.required', ['attribute' => __('Offer Image')]),
            'image.image' => __('validation.image', ['attribute' => __('Offer Image')]),
            'image.mimes' => __('validation.mimes', ['attribute' => __('Offer Image'), 'values' => 'png, jpg, jpeg, webp']),

            'description.required' => __('validation.required', ['attribute' => __('Offer Description')]),
            'description.string' => __('validation.string', ['attribute' => __('Offer Description')]),

            'point.required' => __('validation.required', ['attribute' => __('Offer Point')]),
            'point.numeric' => __('validation.numeric', ['attribute' => __('Offer Point')]),

            // 'discount.required' => __('validation.required', ['attribute' => __('Offer Discount')]),
            // 'discount.numeric' => __('validation.numeric', ['attribute' => __('Offer Discount')]),

            'products.required' => __('validation.required', ['attribute' => __('Products')]),
            'products.array' => __('validation.array', ['attribute' => __('Products')]),
            'products.*.exists' => __('validation.exists', ['attribute' => __('Product')]),

            'branches.required' => __('validation.required', ['attribute' => __('Branches')]),
            'branches.array' => __('validation.array', ['attribute' => __('Branches')]),
            'branches.*.exists' => __('validation.exists', ['attribute' => __('Branch')]),
        ];
    }


    public function isUpdateRequest()
    {
        // تحقق مما إذا كان معرف العرض (id) موجود في الرابط أو في الطلب
        return $this->route('offer') !== null;
    }



}

