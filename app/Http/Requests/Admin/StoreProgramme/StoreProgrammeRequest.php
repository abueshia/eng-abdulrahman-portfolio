<?php

namespace App\Http\Requests\Admin\StoreProgramme;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgrammeRequest extends FormRequest
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
//        dd(1);
        return [
            'name_en' => 'required',
            'name_ar' => 'required',

            'meta_title_en' => 'sometimes',
            'meta_title_ar' => 'sometimes',
            
            'rate' => 'required',
            'star' => 'required|gt:1|lt:7',
            'country_id'   =>'required|exists:countries,id',
            'city_id'      =>'required|exists:cities,id',
            'region_id'      =>'required|exists:regions,id',
            'location_name_en' => 'required',
            'location_name_ar' => 'required',
            'status' => 'nullable',
            'longitude' => 'required',
            'latitude' => 'required',
            'map' => 'required',
            'description' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'group_size' => 'required',
            'tour_type_id' => 'required',
            'duration' => 'required',
            'is_featured' => 'sometimes',
            'tax' => 'sometimes',

            'price' => 'required',
            'discount_type' => 'required|in:percent,fixed',
            'discount' => 'required',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date',

            'itinerary' => 'required',
            'includes' => 'required',

            'email' => 'required',
            'phone' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'gmail' => 'required',
            'main_image' => 'required',
            'banner' => 'required',
            'images' => 'required',

        ];
    }
}

