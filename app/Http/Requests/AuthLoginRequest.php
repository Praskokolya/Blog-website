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
            'nickname.required' => 'Поле имя должно быть обязательным',
            'email.required' => 'Поле email должно быть обязательным',
            'password.required' => 'Поле пароль должно быть обязательным',
            'password.min' => 'Поле пароль должно содержать не менее :min символов',
            'confirmPassword.required' => 'Поле подтверждения пароля должно быть обязательным',
            'confirmPassword.min' => 'Поле подтверждения пароля должно содержать не менее :min символов',
            'email.unique' => "Данный email уже используеться",
            'nickname.unique' => "Этот никнейк занят, выберите другой",
        ];
    }
}
