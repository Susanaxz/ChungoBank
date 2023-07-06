<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;

class CargarVistasController extends Controller
{
    // esto sirve para consultar lógica de negocio y cargar la vista correspondiente
    public function alta_movimientos()
    {
        return view('alta-movimientos');
    }

    public function alta_mto_puntos(){
        return view('alta-mto-puntos');
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
