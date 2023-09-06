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
            'email.required' => 'Поле email должно быть обязательным',
            'password.required' => 'Поле пароль должно быть обязательным',
            'password.min' => 'Поле пароль должно содержать не менее :min символов',
            'email.unique' => "Данный email уже используеться",
        ];
    }
}
