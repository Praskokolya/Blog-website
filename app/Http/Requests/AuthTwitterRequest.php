<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthTwitterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
            'email' => 'required|string|email|unique:registred_users,email', 
            'nickname' => 'required|string|string|unique:registred_users,nickname', 
        ];
    }
}
