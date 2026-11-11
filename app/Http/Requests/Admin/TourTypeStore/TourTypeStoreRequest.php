<?php

namespace App\Http\Requests\admin\TourTypeStore;

use Illuminate\Foundation\Http\FormRequest;

class TourTypeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => 'required|min:2|string|unique:tour_types,name->ar',
            'name_en' => 'required|min:2|string|unique:tour_types,name->en',
        ];
    }
}
