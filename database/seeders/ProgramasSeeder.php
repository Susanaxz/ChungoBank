<?php

namespace Database\Seeders;

use App\Models\Programas;
use App\Models\Personas;
use Illuminate\Database\Seeder;

class ProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea los programas directamente.
        $programas = [
            ['codigo' => 'PBS', 'descripcion' => 'Programa Puntos Básico'],
            ['codigo' => 'PAV', 'descripcion' => 'Programa Puntos Avanzado'],
            ['codigo' => 'PPR', 'descripcion' => 'Programa Puntos Premium']
        ];

        foreach ($programas as $programa) {
            $programasCreated[] = Programas::create($programa);
        }

        // Ahora crea las personas y asigna un programa a cada una.
        Programas::factory()
            ->count(10)
            ->create()
            ->each(function ($persona) use ($programasCreated) {
                // Asigna un programa aleatorio a la persona.
                $persona->programa_id = $programasCreated[array_rand($programasCreated)]->id;
                $persona->save();
            });
    }
}