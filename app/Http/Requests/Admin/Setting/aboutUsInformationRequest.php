<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class aboutUsInformationRequest extends FormRequest
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
            
            // section __three

            'explorer_image'=> 'sometimes',

            'explorer_number.en' => 'required',
            'explorer_number.ar' => 'required',

            'Explorer_title.en' => 'required',
            'Explorer_title.ar' => 'required',

// ******************

            'Winning_award_image' => 'sometimes',

            'Winning_award_number.en' => 'required',
            'Winning_award_number.ar' => 'required',

            'Winning_award_title.en' => 'required',
            'Winning_award_title.ar' => 'required',
            
// ******************

            'Complete_project_image' => 'sometimes',

            'Complete_project_number.en' => 'required',
            'Complete_project_number.ar' => 'required',

            'Complete_project_title.en' => 'required',
            'Complete_project_title.ar' => 'required',

// *********************
            'Client_review_image' => 'sometimes',

            'Client_review_number.en' => 'required',
            'Client_review_number.ar' => 'required',

            'Client_review_title.en' => 'required',
            'Client_review_title.ar' => 'required',



            'Our_Latest_travel_articls_title.en' => 'required',
            'Our_Latest_travel_articls_title.ar' => 'required',


            'Our_Latest_travel_articls_description.en' => 'required',
            'Our_Latest_travel_articls_description.ar' => 'required',
        
        ];
    }}
