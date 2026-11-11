<?php

namespace App\Http\Requests\Front\ProgrammeBooking;

use Illuminate\Foundation\Http\FormRequest;

class ProgrammeBookingCheckoutRequest extends FormRequest
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
            'programme_id' => 'required|exists:programmes,id',
            'check_in' => 'required',
            'adult_search_count' => 'required',
            'children_search_count' => 'required',
            'infant_search_count' => 'required',
            'f_name' => 'sometimes',
            'l_name' => 'sometimes',
            'email' => 'sometimes',
            'phone' => 'sometimes',
            'note' => 'sometimes',
        ];
    }
}
