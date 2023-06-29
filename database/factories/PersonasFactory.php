<?php

namespace Database\Factories;

use App\Models\Personas; // Aquí usamos el namespace correcto para el modelo de Personas
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nif' => $this->faker->unique()->regexify('[0-9]{8}[A-Z]{1}'), 
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'direccion' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'tarjeta' => $this->faker->unique()->regexify('[0-9]{16}'),
        ];
    }
}


