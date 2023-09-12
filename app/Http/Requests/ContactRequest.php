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
            'subject' => 'required|min:1|max:30',
            'message' => 'required|min:15|max:500',
            
        ];
    }
    public function messages(){;
        return [
            'subject.required' => 'The subject field is required',
            'message.required' => 'The message field is required',
        ];   
    }
}
