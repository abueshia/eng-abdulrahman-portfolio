<?php

namespace App\Http\Requests\Front\Flight;

use Illuminate\Foundation\Http\FormRequest;

class FlightSearchRequest extends FormRequest
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
            'air_master_id_from' => 'required',
            'air_master_id_to' => 'required',
            'flight_date' => 'required_if:type,1',
            'daterange' => 'required_if:type,2',
            'type' => 'required',
            'class' => 'required',
            'type_key' => 'required',
            'adult_number' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'air_master_id_from.required' => 'Please Enter The Flying From Field',
            'air_master_id_to.required' => 'Please Enter The Flying To Field',
            'daterange.required_if' => 'Please Enter The Departing and Returning Dates',
        ];
    }
}
