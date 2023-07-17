<?php

namespace Database\Seeders;

use App\Models\Cuenta;
use App\Models\Personas;
use App\Models\Movimientos;
use Illuminate\Database\Seeder;

class CuentasPersonasSeeder extends Seeder
{
    public function run()
    {
        // Crea 10 personas y por cada persona se crea una cuenta
        Personas::factory()
            ->count(10)
            ->create()
            ->each(function ($persona) {
                // Crea una cuenta vinculada a la persona
                $cuenta = Cuenta::factory()
                    ->state(['persona_id' => $persona->id])
                    ->create();

                // Crea 5 movimientos para cada cuenta
                Movimientos::factory()
                    ->count(5)
                    ->state(['cuenta_id' => $cuenta->id])
                    ->create();
            });
    }
}
