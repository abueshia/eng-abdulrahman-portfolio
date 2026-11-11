<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class YourGatewayToAmazingIndexRequest extends FormRequest
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

            // section __one
            'Your_gateway_to_amazing_title.en' => 'required',
            'Your_gateway_to_amazing_title.ar' => 'required',

            'We_have_been_operating_description_one.en' => 'required',
            'We_have_been_operating_description_one.ar' => 'required',



            'Food_title.en' => 'required',
            'Food_title.ar' => 'required',

            'food_image_one' => 'sometimes',

            'Visa_title.en' => 'required',
            'Visa_title.ar' => 'required',

            'visa_image_tow' => 'sometimes',

// ******
            'Historical_title.en' => 'required',
            'Historical_title.ar' => 'required',

            'Historical_image_three' => 'sometimes',

            'Beach_title.en' => 'required',
            'Beach_title.ar' => 'required',

            'Beach_image_four' => 'sometimes',




       
            
            
        
        ];
    }}
