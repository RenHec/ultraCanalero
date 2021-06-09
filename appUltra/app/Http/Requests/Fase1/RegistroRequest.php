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
            'names' => ['required', 'min:5', 'max:50', 'regex:/^([a-zA-Z áéíóúÑñÁÉÍÓÚ]*)+$/'],
            'surnames' => ['required', 'min:5', 'max:50', 'regex:/^([a-zA-Z áéíóúÑñÁÉÍÓÚ]*)+$/'],
            'email' => ['required', 'min:5', 'max:50', 'email:rfc,dns', 'unique:person,email'],
            'phone' => ['required', 'digits:8', 'unique:person,phone', 'regex:/^([2345678])+([0-9]*)+$/'],
            'whatsapp' => ['nullable', 'digits:8', 'regex:/^([2345678])+([0-9]*)+$/'],
            'telegram' => ['nullable', 'digits:8', 'regex:/^([2345678])+([0-9]*)+$/'],
            'birthday' => ['required', "before:{$date}"],
            'g-recaptcha-response' => ['required', 'recaptchav3:contacto,0.5']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'names.required' => 'El nombre es obligatorio.',
            'names.min' => 'El nombre debe tener como mínimo :min caractéres.',
            'names.max' => 'El nombre debe tener como máximo :max caractéres.',
            'names.regex' => 'El nombre ingresado no tiene formato válido.',

            'surnames.required' => 'El apellido es obligatorio.',
            'surnames.min' => 'El apellido debe tener como mínimo :min caractéres.',
            'surnames.max' => 'El apellido debe tener como máximo :max caractéres.',
            'surnames.regex' => 'El apellido ingresado no tiene formato válido.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.min' => 'El correo electrónico debe tener como mínimo :min caractéres.',
            'email.max' => 'El correo electrónico debe tener como máximo :max caractéres.',
            'email.email' => 'El correo electrónico no tiene formato válido.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.digits' => 'El número de teléfono debe de tener :digits dígitos.',
            'phone.unique' => 'El número de teléfono ya se encuentra registrado.',
            'phone.regex' => 'El número de teléfono no tiene formata válido.',

            'whatsapp.digits' => 'El número de whatsapp debe de tener :digits dígitos.',
            'whatsapp.regex' => 'El número de whatsapp no tiene formata válido.',

            'telegram.digits' => 'El número de telegram debe de tener :digits dígitos.',
            'whatsapp.regex' => 'El número de telegram no tiene formata válido.',

            'birthday.required' => 'La fecha de nacimiento es obligatoria.',
            'birthday.before' => 'Para pertenecer a la familia ultra canalera es necesario contar con 7 años de edad.',

            'g-recaptcha-response.required' => 'El sistema detecto que no eres un humano.',
            'g-recaptcha-response.recaptchav3' => 'Estás tratando de hacer algo malo, te estaremos observando..',
        ];
    }
}
