<?php

namespace App\Http\Requests\Admin\City;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable',
            // 'meta_title' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.*.required' => __('validation.required', ['attribute' => 'city name']),
            'name.*.max' => __('validation.max.string', ['attribute' => 'city name', 'max' => 255]),
            'country_id.required' => __('validation.required', ['attribute' => 'country']),
            'country_id.exists' => __('validation.exists', ['attribute' => 'country']),
            'image.required' => __('validation.required', ['attribute' => 'city image']),
            'image.image' => __('validation.image', ['attribute' => 'city image']),
            'image.mimes' => __('validation.mimes', ['attribute' => 'city image', 'values' => 'png,jpg,jpeg,webp']),
        ];
    }
}

