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


    public function consultaMovimientos(Request $request, $id)
    {
        $persona = Personas::with('cuenta')->find($id);

        if (!$persona) {
            return redirect('gestion');
        }

        $cuenta = $persona ? $persona->cuenta : null;
        $query = $cuenta ? $cuenta->movimientos() : Movimientos::query();

        // solo aplica los filtros si es un POST
        if ($request->isMethod('post')) {
            if ($request->filled('fechadesde') && $request->filled('fechahasta')) {
                $query->whereBetween('fecha', [$request->fechadesde, $request->fechahasta]);
            }

            if ($request->filled('operacion') && in_array($request->operacion, ['A', 'D'])) {
                $query->where('operacion', $request->operacion);
            }

            if ($request->filled('concepto')) {
                $query->where('concepto', 'LIKE', '%' . $request->concepto . '%');
            }
        }

        $movimientos = $query->get();

        return view('consulta-movimientos')->with([
            'persona' => $persona,
            'cuenta' => $cuenta,
            'movimientos' => $movimientos,
            'id' => $id 
        ]);
    }

}
