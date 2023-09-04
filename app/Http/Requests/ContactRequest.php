<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',       
            'subject' => 'required|min:1|max:30',
            'message' => 'required|min:15|max:500',
            
        ];
    }
    public function messages(){;
        return [
            'name.required' => 'Поле имя должно быть обязетельным',
            'email.required' => 'Поле email должно быть обязетельным',
            'subject.required' => 'Поле тема сообщения должно быть обязетельным',
            'message.required' => 'Поле сообщение должно быть обязетельным',
        ];   
    }
}
