<?php

namespace Database\Seeders;

use App\Models\Movimientos;
use Illuminate\Database\Seeder;

class MovimientosSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 10 personas y sus cuentas
        Movimientos::factory()
            ->count(10)
            ->create();
    }
}