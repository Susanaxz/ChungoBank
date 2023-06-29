<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nif',
        'nombre',
        'apellidos',
        'direccion',
        'email',
        'tarjeta'
    ];
}
