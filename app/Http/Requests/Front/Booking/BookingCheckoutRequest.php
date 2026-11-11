<?php

namespace App\Http\Requests\Front\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingCheckoutRequest extends FormRequest
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
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required',
            'check_out' => 'required',
            'adult_search_count' => 'required',
            'children_search_count' => 'required',
            'infant_search_count' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'note' => 'sometimes',
            'coupon' => 'sometimes',
        ];
    }
}
