<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Personas extends Model
{
    use HasFactory;
    public static function alta($datos)
    {
        return Personas::create([
            'nif' => $datos['nif'],
            'nombre' => $datos['nombre'],
            'apellidos' => $datos['apellidos'],
            'direccion' => $datos['direccion'],
            'email' => $datos['email'],
            'tarjeta' => $datos['tarjeta']
        ]);
    }

    public function cuenta()
    {
        return $this->hasOne(Cuenta::class, 'persona_id');
    }

    protected $fillable = [
        'nif',
        'nombre',
        'apellidos',
        'direccion',
        'email',
        'tarjeta'
    ];

    public function getCuenta()
    {
        return $this->hasOne(Cuenta::class, 'persona_id')->first();
    }
    public function eliminarConCuenta()
    {
        if ($this->cuenta) {
            return $this->delete();
        } else {
            $this->delete();
            return response()->json(['codigo' => '00', 'respuesta' => ['La persona ha sido eliminada con éxito']]);
        }
    }

}


