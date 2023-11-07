<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nickname' => 'required|string|max:16',
            'interests' => 'max:255|string|sometimes',
            'birthdate' => 'sometimes|string',
            'gender' => 'sometimes|string',
            'image' => 'sometimes',
        ];
    }
}
