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


    protected $fillable = [
        'nif',
        'nombre',
        'apellidos',
        'direccion',
        'email',
        'tarjeta'
    ];
}
