<?php

namespace App\Http\Requests\Fase1;

use Illuminate\Foundation\Http\FormRequest;

class AsignarComisionRequest extends FormRequest
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
            'email' => ['required', 'min:5', 'max:50', 'email:rfc,dns', 'exists:person,email'],
            'commissions' => ['required'],
            'commissions.*' => ['required', 'integer'],
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
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.min' => 'El correo electrónico debe tener como mínimo :min caractéres.',
            'email.max' => 'El correo electrónico debe tener como máximo :max caractéres.',
            'email.email' => 'El correo electrónico no tiene formato válido.',
            'email.exists' => 'El correo electrónico no se encuentra registrado.',

            'commissions.required' => 'Es obligatorio que seleccione al menos una comisión.',
            'commissions.*.required' => 'El sistema detecto que no seleccionó la comisión.',
            'commissions.*.integer' => 'La comisión seleccionada no tiene formato válido.',

            'g-recaptcha-response.required' => 'El sistema detecto que no eres un humano.',
            'g-recaptcha-response.recaptchav3' => 'Estás tratando de hacer algo malo, te estaremos observando..',
        ];
    }
}
