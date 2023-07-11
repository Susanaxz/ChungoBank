<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Programas;
use Exception; // clase para lanzar excepciones y manejar errores
use Illuminate\Support\Facades\DB;

class CargarVistasController extends Controller
{
    // esto sirve para consultar lógica de negocio y cargar la vista correspondiente
    public function alta_movimientos()
    {
        return view('alta-movimientos');
    }

    public function altaMtoPuntos(Request $request)
    {
        try {
            if (!$request->session()->has('idPersona')) {
                throw new Exception("Error Processing Request", 1);
            }

            $id = $request->session()->get('idPersona');
            $persona = Personas::find($id);

            if (!$persona) {
                throw new Exception("Error Processing Request", 1);
            }

            $programas = [
                ['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
                ['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
                ['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']

            ];


            return view('alta-mto-puntos')->with([
                'persona' => $persona,
                'programas' => $programas,
            ]);
        } catch (Exception $e) {
            return redirect('gestion');
        }
    }

    public function alta_personas()
    {
        return view('alta-personas');
    }

    public function consulta_movimientos()
    {
        return view('consulta-movimientos');
    }

    public function detalle_movimiento()
    {
        return view('detalle-movimiento');
    }

    public function gestion()
    {
        if (session()->has('idPersona')) {
            $id = session('idPersona');
            $persona = Personas::find($id);
            $datos['persona'] = $persona;
            $datos['titulo'] = 'Gestión comercial';

            // si la sesion existe carga la vista gestion
            return view('gestion')->with($datos);
        } else {
            // si la sesion no existe carga la vista login
            return redirect('gestion');
        }
    }
}