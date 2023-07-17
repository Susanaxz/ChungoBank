<?php

namespace Database\Seeders;

use App\Models\Cuentas;
use Illuminate\Database\Seeder;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 10 personas y sus cuentas
        Cuenta::factory()
            ->count(10)
            ->create();
    }
}