<?php

namespace App\Http\Controllers;


use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\nifExists;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PersonasController extends Controller
{
    public function consulta($nif = null)
    {
        $data['nif'] = $nif;

        $rules = array(
            'nif' => ["required", new nifExists]
        );

        $messages = array(
            'nif.required' => 'El campo nif es obligatorio'
        );

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $datos['errors'] = $validator->messages();
            session()->forget('idPersona');
        } else {
            $persona = Personas::where('nif', $data['nif'])->first();

                // comprobamos si existe la persona en la base de datos
            if ($persona === null) {
                return redirect()->back()->withErrors(['nif' => 'No se encontró ninguna persona con ese NIF']);
            }

            session(['idPersona' => $persona->id]);
            $datos['persona'] = $persona;
        }


        $datos['titulo'] = 'Gestión comercial';

        return view('gestion', $datos);
    }

    public function alta(Request $request)
    {
        $datos = $request->all();
        
        if (isset($datos['tarjeta1']) && isset($datos['tarjeta2']) && isset($datos['tarjeta3']) && isset($datos['tarjeta4'])) {
            $datos['tarjeta'] = $datos['tarjeta1'] . $datos['tarjeta2'] . $datos['tarjeta3'] . $datos['tarjeta4'];
        }
        $datos['tarjeta'] = $datos['tarjeta1'] . $datos['tarjeta2'] . $datos['tarjeta3'] . $datos['tarjeta4'];

        $validator = Validator::make($datos, [
            'nif' => 'required|unique:personas,nif',
            'nombre' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'email' => 'required|email',
            'tarjeta1' => 'required|digits:4',
            'tarjeta2' => 'required|digits:4',
            'tarjeta3' => 'required|digits:4',
            'tarjeta4' => 'required|digits:4',
        ],
        [
            'nif.required' => 'El campo nif es obligatorio',
            'nif.unique' => 'El nif ya existe en la base de datos',
            'nombre.required' => 'El campo nombre es obligatorio',
            'apellidos.required' => 'El campo apellidos es obligatorio',
            'direccion.required' => 'El campo dirección es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser una dirección de correo válida',
        ]
        );

        if ($validator->fails()) {
            return redirect()->route('personas.showForm')
            ->withInput()
            ->withErrors($validator);
        } else {
            try {
                $persona = Personas::create($datos);
                session()->flash('success', 'Persona creada exitosamente!');
                $datos['persona'] = $persona;
                $datos['titulo'] = 'Alta Personas';
                

                session(['idPersona' => $persona->id]);

                return view('alta-personas')->with($datos);
            } catch (QueryException $e) {
                $errores = ['errorbbdd' => $e->errorInfo[2]];

                return back()->withErrors($errores)->withInput();
            }
        }
    }

    public function showForm()
    {
        $tarjeta = rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999);
        $tarjetaChunks = str_split($tarjeta, 4);

        $datos['tarjeta1'] = $tarjetaChunks[0];
        $datos['tarjeta2'] = $tarjetaChunks[1];
        $datos['tarjeta3'] = $tarjetaChunks[2];
        $datos['tarjeta4'] = $tarjetaChunks[3];

        return view('alta-personas', $datos);
    }

    public function show($nif)
    {
        $persona = Personas::where('nif', $nif)->with('cuentas')->first();

        if (!$persona) {
            return back()->withErrors(['nif' => 'Persona no encontrada']);
        }

        return view('alta-mto-puntos', compact('persona'));
    }

    public function destroy($id)
    {
        $persona = Personas::find($id);

        if (!$persona) {
            // No se encontró la persona
            return response()->json(['message' => 'No se encontró la persona.'], 404);
        }

        $persona->eliminarConCuenta();

        return response()->json(['message' => 'Persona y su cuenta eliminadas con éxito.']);
    }
    
}

