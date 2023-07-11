<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    use HasFactory;

    protected $fillable = [
        'entidad',
        'oficina',
        'dc',
        'cuenta',
        'programa',
        'extracto',
        'renuncia',
        'saldo',
        'fechaextracto',
        'persona_id' // Para relacionar la cuenta con la persona
    ];

    public static function alta($datos)
    {
        return Cuentas::create([
            'entidad' => $datos['entidad'],
            'oficina' => $datos['oficina'],
            'dc' => $datos['dc'],
            'cuenta' => $datos['cuenta'],
            'programa' => $datos['programa'],
            'extracto' => $datos['extracto'],
            'renuncia' => $datos['renuncia'],
            'saldo' => $datos['saldo'],
            'fechaextracto' => $datos['fechaextracto'],
            'persona_id' => $datos['persona_id'] // Para relacionar la cuenta con la persona
        ]);
    }

    public function persona()
    {
        return $this->belongsTo(Personas::class); // la relación es uno a uno
    }

    public function movimientos()
    {
        return $this->hasMany(Movimientos::class); // la relación es uno a muchos
    }
}
