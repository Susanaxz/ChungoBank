<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
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

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'persona_id'); // la relación es uno a uno
    }

    public function movimientos()
    {
        return $this->hasMany(Movimientos::class); // la relación es uno a muchos
    }

    public function programa()
    {
        return $this->belongsTo(Programas::class); // la relación es uno a uno
    }

    public function getPrograma()
    {
        return $this->hasOne(Programas::class, 'codigo', 'programa')->first();
    }
}
