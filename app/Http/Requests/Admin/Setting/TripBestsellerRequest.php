<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class TripBestsellerRequest extends FormRequest
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
            'name_Bestseller.en' => 'required',
            'name_Bestseller.ar' => 'required',


            'name_Adults.en' => 'required',
            'name_Adults.ar' => 'required',

            'name_Children.en' => 'required',
            'name_Children.ar' => 'required',

            'name_Infants.en' => 'required',
            'name_Infants.ar' => 'required',

            'name_Book_Now.en' => 'required',
            'name_Book_Now.ar' => 'required',


            'name_Add_to_Wishlist.en' => 'required',
            'name_Add_to_Wishlist.ar' => 'required',

     
        
        ];
    }}
