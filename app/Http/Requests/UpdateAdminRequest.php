<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email->ignore($user->id)',
            'permissions' => 'required|min:1',
            'password' => 'nullable|between:8,255|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيمة المدخلة غير صحيحة',
            'name.string' => 'اسم اللغة لابد ان يكون احرف',
            'name.max' => ' اسم اللغة لابد ان لا يزيد عن 100 حرف',
            'email.required' => 'يجب الدخال البريد الالكتروني ',
            'email.email' => 'صيغة البريد الالكتروني غير صحيحة ',
            'password.required' => 'يجب الدخال كلمة المرور',
            'password.' => 'يجب الدخال كلمة المرور'
            
            ];
    }
}