<?php

namespace Database\Factories;

use App\Models\Programas; 

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Programas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $programas = [
            ['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
            ['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
            ['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']

        ];
        return [
            'codigo' => $programas[$this->faker->numberBetween(0, 2)]['codigo'],
            'descripcion' => $programas[$this->faker->numberBetween(0, 2)]['descripcion']
        ];
    }
}