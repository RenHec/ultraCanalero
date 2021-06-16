<?php

namespace App\Http\Controllers\Fase1\Invitacion;

use Illuminate\Http\Request;
use App\Models\Fase1\Persona;
use App\Models\Fase1\Comision;
use App\Models\Fase1\EmailSend;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Fase1\PersonaComision;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvitacionController extends Controller
{
    public function accept($friend, $token)
    {
        try {
            $email_send = EmailSend::where('title', EmailSend::INVITACION)->where('answer', false)->where('token', $token)->first();
            if (is_null($email_send)) {
                return view('errors.error', ['title' => 'Clave incorrecta', 'description' => 'La clave de invitación no es válida, por favor comuniquese con cualquier miembro de la Junta Directiva para mayor información.']);
            } else {
                $commission = mb_strtolower($email_send->description);
                $person = $email_send->person->getFullNameAttribute();
                $token = $email_send->token;
                return view('invitation.acept', compact('commission', 'person', 'token'));
            }
        } catch (\Exception $e) {
            return view('errors.error', ['title' => '500', 'description' => 'Disculpe los inconvenientes, si el problema persiste por favor comunicarce con el administrador.']);
        }
    }

    public function store_accept(Request $request)
    {
        if ($request->ajax()) {
            Validator::make(
                $request->all(),
                [
                    'firm' => 'required',
                    'clave' => 'required|exists:email_send,token',
                    'email' => 'required|exists:person,email|email:rfc,dns',
                    'recaptcha' => 'required|recaptchav3:contacto,0.5',
                ],
                [
                    'firm.required' => 'Es necesario que ingresa la firma.',
                    'clave.required' => 'La clave de invitación es obligatoria.',
                    'clave.exists' => 'La clave de invitación no se encuentra en los registros.',
                    'email.required' => 'El correo electrónico es obligatorio.',
                    'email.email' => 'El correo electrónico no tiene formato válido.',
                    'email.exists' => 'El correo electrónico no se encuentra registrado.',
                    'recaptcha.required' => 'El sistema detecto que no eres un humano.',
                    'recaptcha.recaptchav3' => 'Estás tratando de hacer algo malo, te estaremos observando..',
                ]
            )->validate();

            try {

                $db = DB::connection('mysql');

                $email_send = EmailSend::where('email', $request->email)->where('token', $request->clave)->first(); //Seleccionamos el correo enviado
                $person = Persona::where('email', $request->email)->first(); //Seleccionamos la persona que recibio el correo
                $commission = Comision::where('name', $email_send->description)->first(); //Seleccionamos la comisión que liderará

                $img = $this->getB64Image($request->firm);
                $image = Image::make($img);
                $image->fit(870, 620, function ($constraint) {
                    $constraint->upsize();
                });
                $image->encode('png', 70);
                $name_firm = str_replace(['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', ' '], '', $person->getFullNameAttribute());
                $path = "{$commission->id}/{$name_firm}.png";

                $person_commission = PersonaComision::where('person_id', $person->id)->where('commission_id', $commission->id)->first();
                $person_commission->leader = true;
                $person_commission->firm = $path;
                $person_commission->save();

                $email_send->answer;
                $email_send->save();

                Storage::disk('firma')->put($path, $image);

                $db->commit();
                return redirect()->route('welcome');
            } catch (\Exception $e) {
                $db->rollBack();
                return response()->json(['data' => 'Ocurrio un error en el proceso.'], 500);
            }
        } else {
            return response()->json(['data' => 'Petición HTTP inválida.'], 500);
        }
    }

    public function denies($friend, $token)
    {
        try {
            $email_send = EmailSend::where('title', EmailSend::INVITACION)->where('answer', false)->where('token', $token)->first();
            if (is_null($email_send)) {
                return view('errors.error', ['title' => 'Clave incorrecta', 'description' => 'La clave de invitación no es válida, por favor comuniquese con cualquier miembro de la Junta Directiva para mayor información.']);
            } else {
                $friend = str_replace('-', ' ', $friend);
                return view('errors.error', ['title' => '¡Gracias por tu respuesta!', 'description' => "<strong>Hola, </strong>{$friend} agradecemos que respondieras nuestra invitación. Espereamos que nos sigas apoyando, la familia Ultra Canalera te lo agradece."]);
            }
        } catch (\Exception $e) {
            return view('errors.error', ['title' => '500', 'description' => 'Disculpe los inconvenientes, si el problema persiste por favor comunicarce con el administrador.']);
        }
    }
}
