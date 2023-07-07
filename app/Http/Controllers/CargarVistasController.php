<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Programas;
use Exception;

class CargarVistasController extends Controller
{
    // esto sirve para consultar lógica de negocio y cargar la vista correspondiente
    public function alta_movimientos()
    {
        return view('alta-movimientos');
    }

    public function altaMtoPuntos()
    {
        // Comprobamos si existe la variable de sesión 'idPersona'
        if (!session()->has('idPersona')) {
            throw new Exception("Error Processing Request", 1);
        }

        // Recuperamos el ID de la variable de sesión
        $id = session('idPersona');
        if (!$datos['persona'] = Personas::find($id)) {
            throw new Exception("Error Processing Request", 1);
        }

        $datos['programas'] = Programas::all(['codigo', 'descripcion']);

        return view('alta-mto-puntos')->with($datos);
    }

    public function alta_personas(){
        return view('alta-personas');
    }

    public function consulta_movimientos(){
        return view('consulta-movimientos');
    }

    public function detalle_movimiento(){
        return view('detalle-movimiento');
    }

    public function gestion()
    {
        if (session()->has('idPersona')) {
            $id = session('idPersona');
            $persona = Personas::find($id);
            $datos['persona'] = $persona;
        }

        $datos['titulo'] = 'Gestión comercial';

        return view('gestion')->with($datos);
    }


    public function login(){
        return view('login');
    }


}
