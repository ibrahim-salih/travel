<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactWebRequest extends FormRequest
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
            'contacts.*.email' => 'required|email|unique:contactus,email',
            'contacts.*.phone' => 'required|min:11|max:15|regex:/(01)[0-9]{9}/|unique:contactus,phone',
            'contacts.*.address' => 'required|string|max:150',
        ];
    }
    
    public function messages()
    {
        return [
            'required' => 'This field is required',
            'address.string' => 'The site name must be in letters',
            'address.max' => 'The site name must be no more than 150 characters long',
            'email.required' => 'يجب الدخال البريد الالكتروني ',
            'email.email' => 'صيغة البريد الالكتروني غير صحيحة ',
            'phone.numeric' => 'The keywords must be in numeric',
            'phone.max' => 'The description must be no more than 15 characters long',
        ];
    }
    
}
