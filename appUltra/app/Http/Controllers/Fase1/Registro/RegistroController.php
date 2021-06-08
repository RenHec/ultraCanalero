<?php

namespace App\Http\Controllers\Fase1\Registro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fase1\RegistroRequest;
use App\Models\Fase1\Comision;
use App\Models\Fase1\Persona;
use App\Models\Fase1\PersonaComision;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index()
    {
        $comissions = Comision::all();
        return view('auth.register', compact('comissions'));
    }

    public function store(RegistroRequest $request)
    {
        if (!is_null($request->whatsapp) && str_replace(' ', '', $request->whatsapp) != '' && isset($request->whatsapp)) {
            if (!is_null(Persona::where('whatsapp', $request->whatsapp)->first())) {
                return redirect()->route('registro.index')->with('warning', "El whatsapp con número {$request->whatsapp}, ya se encuentra registrado en el sistema.");
            }
        }

        if (!is_null($request->telegram) && str_replace(' ', '', $request->telegram) != '' && isset($request->telegram)) {
            if (!is_null(Persona::where('telegram', $request->telegram)->first())) {
                return redirect()->route('registro.index')->with('warning', "El telegram con número {$request->telegram}, ya se encuentra registrado en el sistema.");
            }
        }

        try {
            $db = DB::connection('mysql');

            $db->beginTransaction();

            $data = $request->all();
            $data['information'] = mb_strtolower($request->information) == 'on' ? true : false;
            $insert = Persona::create($data);

            if (isset($request->commissions)) {
                foreach ($request->commissions as $value) {
                    $comision = PersonaComision::where('person_id', $insert->id)->where('commission_id', $value)->first();
                    if (is_null($comision)) {
                        $comision = new PersonaComision();
                    }
                    $comision->person_id = $insert->id;
                    $comision->commission_id = $value;
                    $comision->save();
                }
            }

            $db->commit();

            return redirect()->route('registro.index')->with('success', "¡Gracias! <b>{$request->names} {$request->surnames}</b> por registrarte en la familia ultra canalera.");
        } catch (\Exception $e) {
            $db->rollBack();
            return redirect()->route('registro.index')->with('danger', "Ocurrio un problema al ingresar la información a la base de datos. {$e}");
        }
    }
}
