<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Personas;

class nifExists implements ValidationRule
{
    /**
     * Run the validation rule.
     * En este código, primero intentamos obtener un registro
     * Personas con el valor de nif proporcionado. Si no encontramos
     * un registro que coincida, llamamos al Closure $fail con el mensaje
     * de error deseado. Laravel se encarga de asociar este mensaje con
     * el atributo que se está validando
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $person = Personas::where('nif', $value)->first();

        if ($person === null) {
            $fail(':attribute no existe en la base de datos');
        }

    }  
       
}