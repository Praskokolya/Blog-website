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
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
            'email' => 'required|string|email|unique:registred_users,email', 
            'nickname' => 'required|string|string|unique:registred_users,nickname', 

        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'The password field is required',
            'password.min' => 'The password field must contain at least :min characters',
            'confirmPassword.required' => 'The confirm password field is required',
            'confirmPassword.min' => 'The confirm password field must contain at least :min characters',
            'email.unique' => 'This email is already in use',
            'nickname.unique' => 'This nickname is already taken, please choose another',
        ];
    }
}
