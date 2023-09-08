<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field is required',
            'password.required' => 'The password field is required',
            'password.min' => 'The password field must be at least :min characters',
            'email.unique' => 'This email is already in use',
        ];
    }
}
