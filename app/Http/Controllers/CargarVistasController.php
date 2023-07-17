<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Programas;
use App\Models\Cuenta;
use App\Models\Movimientos;
use Exception; // clase para lanzar excepciones y manejar errores
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CargarVistasController extends Controller
{
    // esto sirve para consultar lógica de negocio y cargar la vista correspondiente
    public function altaMovimientos()
    {
        return view('alta-movimientos');
    }

    public function altaMtoPuntos(Request $request)
    {
        $id = $request->session()->get('idPersona', null);
        if ($id == null) {
            return redirect('gestion');
        }

        $persona = Personas::with('cuenta.programa')->find($id);
        $programas = Programas::all();
        $cuenta = $persona ? $persona->cuenta : null;
        $programaActual = $cuenta ? $cuenta->programa : null;

        return view('alta-mto-puntos')->with([
            'persona' => $persona,
            'programas' => $programas,
            'cuenta' => $cuenta,
            'programaActual' => $programaActual
        ]);
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
        $id = session('idPersona', null);
        $persona = Personas::find($id);
        $datos['persona'] = $persona;
        $datos['titulo'] = 'Gestión comercial';

        return view('gestion')->with($datos);
    }

    
    public function altaCuenta(Request $request)
    {
        $id = $request->session()->get('idPersona', null);
        if ($id == null) {
            return redirect('gestion');
        }

        $persona = Personas::find($id);
        if ($persona) {
            $cuenta = new Cuenta();
            $cuenta->persona_id = $persona->id;
            $cuenta->programa_id = $request->programa_id;
            $cuenta->extracto = $request->has('extracto') ? 1 : 0;
            $cuenta->renuncia = $request->has('renuncia') ? 1 : 0;
            $cuenta->save();
                       
        }
    }

    
}
