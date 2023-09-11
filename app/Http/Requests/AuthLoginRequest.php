<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nickname' => 'required|string|max:255|unique:registred_users,nickname',
            'email' => 'required|email|unique:registred_users,email|max:255',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
        ];
    }
    public function messages()
    {
        return [
            'nickname.required' => 'The nickname field is required',
            'email.required' => 'The email field is required',
            'password.required' => 'The password field is required',
            'password.min' => 'The password field must contain at least :min characters',
            'confirmPassword.required' => 'The confirm password field is required',
            'confirmPassword.min' => 'The confirm password field must contain at least :min characters',
            'email.unique' => 'This email is already in use',
            'nickname.unique' => 'This nickname is already taken, please choose another',
        ];
    }
}
