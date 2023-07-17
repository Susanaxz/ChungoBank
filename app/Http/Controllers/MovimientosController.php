<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Movimientos;
use App\Models\Cuenta;
use App\Models\Personas;

class MovimientosController extends Controller
{
    public function altaMovimientos()
    {
        return view('alta-movimientos');
    }



    public function consultaMovimientos($id)
    {
        $persona = Personas::with('cuenta')->find($id);

        if (!$persona) {
            return redirect('gestion');
        }

        $cuenta = $persona ? $persona->cuenta : null;

        return view('consulta-movimientos')->with([
            'persona' => $persona,
            'cuenta' => $cuenta,
        ]);
    }

}

