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

    public function altaCuenta(Request $request, $persona_id)
{
    $persona = Personas::find($persona_id);
    if (!$persona) {
        $respuesta = array('codigo' => '10', 'respuesta' => ['No existe la persona']);
        return response()->json($respuesta);
    } else {
        $cuenta = Cuenta::where('persona_id', $persona_id)->first();
        if ($cuenta) {
            $respuesta = array('codigo' => '10', 'respuesta' => ['Ya existe la cuenta']);
            return response()->json($respuesta);
        } else {
            $cuenta = new Cuenta;
            $cuenta->persona_id = $persona_id;
            $cuenta->programa = $request->programa_id;
            $cuenta->extracto = $request->has('extracto') ? 1 : 0;
            $cuenta->renuncia = $request->has('renuncia') ? 1 : 0;
            $cuenta->saldo = 0;
            $cuenta->fechaextracto = mt_rand() % 2 == 0 ? date('Y-m-d', strtotime('-1 month')) : date('Y-m-d'); // Genera una fecha aleatoria entre el día de hoy y hace un mes

            // Generación de los valores que faltaban
            $cuenta->entidad = mt_rand(1000,9999); // Genera un número aleatorio de 4 dígitos
            $cuenta->oficina = mt_rand(1000,9999); // Genera un número aleatorio de 4 dígitos
            $cuenta->dc = mt_rand(10,99); // Genera un número aleatorio de 2 dígitos
            $cuenta->cuenta = mt_rand(1,9) . mt_rand(100000000,999999999); // Genera un número aleatorio de 1 dígito seguido de uno de 9 dígitos

            $cuenta->save();

            $respuesta = array('codigo' => '00', 'respuesta' => ['Cuenta creada con éxito']);
            return redirect()->back()->with('message', 'Cuenta creada con éxito');
        }
    }
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