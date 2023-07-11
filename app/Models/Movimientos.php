<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    use HasFactory;
    
    public static function movimientos($datos)
    {
        return Movimientos::create([
            'fecha' => $datos['fecha'],
            'operacion' => $datos['operacion'],
            'concepto' => $datos['concepto'],
            'puntos' => $datos['puntos'],
            'saldomov' => $datos['saldomov'],
            'tarjeta' => $datos['tarjeta'],
            'localizador' => $datos['localizador'],
            'comercio' => $datos['comercio'],
            'comentarios' => $datos['comentarios'],
            'cuenta_id' => $datos['cuenta_id']
        ]);
    }

    protected $fillable = [
        'fecha',
        'operacion',
        'concepto',
        'puntos',
        'saldomov',
        'tarjeta',
        'localizador',
        'comercio',
        'comentarios',
        'cuenta_id'
    ];
//  Relación de uno a muchos inversa (muchos a uno) de movimientos a cuentas
    public function cuenta()
   {
        return $this->hasOne(Cuentas::class);
  }
}
