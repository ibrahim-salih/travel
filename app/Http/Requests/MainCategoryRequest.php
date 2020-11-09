<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category' => 'required|array|min:1',
            'category.*.name' => 'required',
            'category.*.abbr' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
            'name.max' => ' اسم اللغة لابد ان لا يزيد عن 100 حرف',
            'abbr.string' => 'اسم  أختصار اللغة لابد ان يكون احرف',
            'abbr.max' => ' اسم  أختصار اللغة لابد ان لا يزيد عن 10 حرف',
        ];
    }
    
}
