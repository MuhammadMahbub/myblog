<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name' => ['required', 'string', 'max:200'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_keyword' => ['required'],
            'category_photo' => ['required', 'mimes:png,jpg,jpeg'],
            'status' => ['nullable'],
        ];
    }
}
