<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class settingBlogDetailsGetUpdateRequest extends FormRequest
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
            'Leave_Comment_title.en' => 'required',
            'Leave_Comment_title.ar' => 'required',

            'Your_email_address_description.en' => 'required',
            'Your_email_address_description.ar' => 'required',



            'Search_Here_title.en' => 'required',
            'Search_Here_title.ar' => 'required',


            'Category_title.en' => 'required',
            'Category_title.ar' => 'required',


            'Recent_blog_title.en' => 'required',
            'Recent_blog_title.ar' => 'required',


            'Popular_Tag_title.en' => 'required',
            'Popular_Tag_title.ar' => 'required',

        
        ];
    }}
