<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
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
            'Name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'age' => 'required',
            'institute' => 'required',
            'Identity' => 'required|image',
            'image' => 'required|image',
        ];
    }
    public function message()
    {
        return[
        'Name.required' => 'Name is required',
        'email.required' => 'Email is required',
        'gender.required' => 'Gender is required',
        'age.required' => 'Age is required',
        'institute.required' => 'Institute is required',
        'Identity.required' => 'Identity is required',
        'image.required' => 'Image is required',
       ];
    }
}
