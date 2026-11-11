<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255', 
            'email'    => 'required|email|unique:users,email',
            'branche_id' => 'required|exists:branches,id', 
            'role_id' => 'required|exists:roles,id', 
            'password' => 'required|min:6',  
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }



}