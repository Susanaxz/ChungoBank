<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuentas;
use App\Models\Personas;
use Illuminate\Support\Facades\Redirect;

class CuentasController extends Controller
{
    public function show(Request $request)
    {
        $persona = Personas::find($request->input('persona_id'));

        if (!$persona) {
            // Si no se seleccionó una persona, redirigir o mostrar un mensaje
            // Aquí estoy redirigiendo, pero puedes cambiar esto para que se ajuste a tus necesidades
            return Redirect::route('gestion');
        }

        $cuenta = $persona->cuentaPuntos;

        if (!$cuenta) {
            // Si la persona no tiene una cuenta, muestra un mensaje
            // De nuevo, ajusta esto a tus necesidades
            return view('gestion', ['mensaje' => 'Esta persona no tiene una cuenta']);
        }

        // Si la persona tiene una cuenta, muestra los datos de la cuenta
        return view('alta-mto-puntos', ['cuenta' => $cuenta]);
    }

    public function store(Request $request)
    {
        $persona = Personas::find($request->input('persona_id'));

        if (!$persona) {
            // Si no se seleccionó una persona, redirige o muestra un mensaje
            return Redirect::route('gestion');
        }

        $cuenta = $persona->cuentaPuntos;

        if ($cuenta) {    
            return response()->json(['mensaje' => 'Esta persona ya tiene una cuenta'], 403);
        }

        // Crea una nueva cuenta
        $datos = $request->all();
        $datos['persona_id'] = $persona->id;
        Cuentas::alta($datos);

        // Redirige a la vista de la cuenta o devuelve una respuesta adecuada
        return Redirect::route('alta-mto-puntos', ['cuenta_id' => $persona->cuentaPuntos->id]);
    }
}