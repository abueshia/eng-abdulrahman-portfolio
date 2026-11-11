<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class settingIndexRequest extends FormRequest
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
             'image_panarea' => 'sometimes',

            'image_panarea_tow' => 'sometimes',

            'image_panarea_three' => 'sometimes',

            'Your_gateway_title.en' => 'required',
            'Your_gateway_title.ar' => 'required',

            'travel_agency_description.en' => 'required',
            'travel_agency_description.ar' => 'required',

            'Find_Popular_Hotels_title.en' => 'required',
            'Find_Popular_Hotels_title.ar' => 'required',


            'Find_Popular_Flights_title.en' => 'required',
            'Find_Popular_Flights_title.ar' => 'required',


            'Find_Popular_Tours_title.en' => 'required',
            'Find_Popular_Tours_title.ar' => 'required',


            'Whether_you’re_description.en' => 'required',
            'Whether_you’re_description.ar' => 'required',

            'Get_up_to_title.en' => 'required',
            'Get_up_to_title.ar' => 'required',

            
            
        
        ];
    }}
