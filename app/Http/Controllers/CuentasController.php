<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Cuenta;
use App\Models\Personas;
use App\Models\Programas;

class CuentasController extends Controller
{
    public function show(Request $request)
    {
        $programas = $this->getProgramas();
        foreach ($programas as $programa) {
        }
        $programas = Programas::all();
        return view('alta-mto-puntos', compact('programas'));
    }


    public function store(Request $request)
    {
        $persona = Personas::find($request->session()->get('idPersona'));

        $cuenta = $persona ? $persona->cuenta : null;

        if (!$cuenta) {
            $datos = $request->all();
            $datos['persona_id'] = $persona ? $persona->id : null;
            Cuenta::create($datos);
        }

        $request->session()->put('idPersona', $persona ? $persona->id : null);
        return $this->show($request);
    }

    public function getProgramas()
    {
        return collect([
            (object) ['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
            (object) ['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
            (object) ['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']
        ]);
    }

    public function index()
    {
        $programas = Programas::pluck('descripcion', 'codigo');
        return view('alta-mto-puntos', compact('programas'));
    }


    public function consulta(Personas $persona)
    {
        $cuenta = $persona->getCuenta();


        // busca el programa que corresponde al código del programa en la cuenta
        $programa = $cuenta ? $cuenta->getPrograma() : null;

        $cuenta = $cuenta ? $cuenta : new Cuenta;
        $cuenta->descripcion = $programa ? $programa->descripcion : '';

        $respuesta = array('codigo' => '00', 'respuesta' => $cuenta);

        return response()->json($respuesta);
    }

    public function alta()
    {
        $data = request()->all();

        $rules = [
            'persona_id' => "required|numeric|gt:0|unique:cuentas,persona_id",
            'programa' => 'required|size:3'
        ];

        $messages = [
            'persona_id.required' => 'Se debe seleccionar una persona previamente',
            'persona_id.numeric' => 'Se debe seleccionar una persona previamente',
            'persona_id.gt' => 'Se debe seleccionar una persona previamente',
            'persona_id.unique' => 'Sólo se permite una cuenta puntos por persona',
            'programa.required' => 'Se debe seleccionar un programa',
            'programa.size' => 'El programa debe tener 3 caracteres'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->stopOnFirstFailure()->fails()) {
            $datos['errors'] = $validator->messages()->all();
            $respuesta = array('codigo' => '10', 'respuesta' => $datos['errors']);
            return response()->json($respuesta);
        }

        // Validación adicional para comprobar el programa
        $programas = Programas::all('codigo')->pluck('codigo')->toArray();
        if (!in_array($data['programa'], $programas)) {
            $respuesta = array('codigo' => '20', 'respuesta' => ["Código de programa {$data['programa']} no existe"]);
            return response()->json($respuesta);
        }

        // Asignación de número de cuenta aleatorio
        $data['entidad'] = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $data['oficina'] = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $data['dc'] = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        $data['cuenta'] = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

        // Manejo de las casillas de verificación de extracto y renuncia de puntos
        $data['extracto'] = $data['extracto'] ? 1 : 0;
        $data['renuncia'] = $data['renuncia'] ? 1 : 0;

        // Llama al método de alta definido en el modelo
        $cuenta = Cuenta::create($data);

        // Confecciona el mensaje de respuesta enviando el número de cuenta asignado por el controlador
        $respuesta = array('codigo' => '00', 'respuesta' => ['Cuenta creada con éxito: ' . $cuenta->id]);

        return response()->json($respuesta);
    }

    public function modificarCuenta(Request $request, $persona_id)
    {
        $cuenta = Cuenta::where('persona_id', $persona_id)->first();

        if (!$cuenta) {
            $respuesta = array('codigo' => '10', 'respuesta' => ['No existe la cuenta']);
            return response()->json($respuesta);
        } else {
            $cuenta->programa = $request->programa_id;
            $cuenta->extracto = $request->has('extracto') ? 1 : 0;
            $cuenta->renuncia = $request->has('renuncia') ? 1 : 0;

            $cuenta->save();

            return redirect()->back()->with('message', 'Cuenta modificada con éxito');
        }
    }
}