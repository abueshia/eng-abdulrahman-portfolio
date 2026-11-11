<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class aboutUsPopularDestinationsRequest extends FormRequest
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

            'section_four_title_one.en' => 'required',
            'section_four_title_one.ar' => 'required',

            'section_four_description_one.en' => 'required',
            'section_four_description_one.ar' => 'required',

            // stare
            'Weekend_Wonders_title.en' => 'required',
            'Weekend_Wonders_title.ar' => 'required',

            'Weekend_Wonders_nember' => 'required',

            'Weekend_Wonders_image' => 'sometimes',
            // 

            'Eco_Tours_title.en' => 'required',
            'Eco_Tours_title.ar' => 'required',

            'Eco_Tours_nember' => 'required',

            // 'Eco_Tours_image' => 'sometimes',

            // 
            'Beach_Tour_title.en' => 'required',
            'Beach_Tour_title.ar' => 'required',

            'Beach_Tour_nember' => 'required',

            // 'Beach_Tour_image' => 'sometimes',
            // 
            'Heritage_Tours_title.en' => 'required',
            'Heritage_Tours_title.ar' => 'required',

            'Heritage_Tours_nember' => 'required',

            // 'Heritage_Tours_image' => 'sometimes',

        
        ];
    }}

