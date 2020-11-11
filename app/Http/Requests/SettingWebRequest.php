<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingWebRequest extends FormRequest
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
            'settings.*.keywords' => 'required|string|max:255',
            'settings.*.title' => 'required|string|max:150',
            'settings.*.description' => 'required|string|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'required' => 'This field is required',
            'title.string' => 'The site name must be in letters',
            'title.max' => 'The site name must be no more than 150 characters long',
            'description.string' => 'The description must be in letters',
            'description.max' => 'The description must be no more than 255 characters long',
            'keywords.string' => 'The keywords must be in letters',
            'keywords.max' => 'The description must be no more than 255 characters long',
        ];
    }
    
}
