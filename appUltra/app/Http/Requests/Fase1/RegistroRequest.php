<?php

namespace App\Http\Requests\Fase1;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
        $date = date("Y-m-d");
        $date = date("Y-m-d", strtotime($date . "- 5 year"));
        return [
            'names' => ['required', 'min:5', 'max:50', 'unique:person,names'],
            'surnames' => ['required', 'min:5', 'max:50', 'unique:person,surnames'],
            'email' => ['required', 'min:5', 'max:50', 'email', 'unique:person,email'],
            'phone' => ['required', 'digits:8', 'unique:person,phone'],
            'whatsapp' => ['nullable', 'digits:8'],
            'telegram' => ['nullable', 'digits:8'],
            'birthday' => ['required', "before:{$date}"]
        ];
    }
}
