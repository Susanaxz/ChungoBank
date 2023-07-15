<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;

use App\Models\Personas;
use App\Models\Programas;

class CuentasController extends Controller
{
    public function show(Request $request)
    {
        $programas = $this->getProgramas();
        foreach ($programas as $programa) {
            var_dump($programa);
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
            (object)['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
            (object)['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
            (object)['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']
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
}
