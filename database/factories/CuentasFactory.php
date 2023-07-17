<?php

namespace Database\Factories;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;

class CuentasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuenta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $persona = Personas::factory()->create(); // Creamos una persona para asociarla a la cuenta
        $programas = [
            ['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
            ['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
            ['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']
        ];

        $programa = $programas[array_rand($programas)];
        
        return [
            'entidad' => $this->faker->randomNumber(4, true),
            'oficina' => $this->faker->randomNumber(4, true),
            'dc' => $this->faker->randomNumber(2, true),
            'cuenta' => $this->faker->numberBetween(1, 9) . $this->faker->randomNumber(9, true),
            'programa' => $programa['codigo'],
            'extracto' => $this->faker->randomElement([0, 1]),
            'renuncia' => $this->faker->randomElement([0, 1]),
            'saldo' => $this->faker->randomFloat(2, 0, 99999),
            'fechaextracto' => $this->faker->date(),
            'persona_id' => $persona->id,
        ];
    }
}