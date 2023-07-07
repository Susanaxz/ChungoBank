<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    protected $table = 'programas';
    protected $fillable = ['codigo', 'descripcion'];
}

?>