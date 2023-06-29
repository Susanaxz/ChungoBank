<?php

namespace Database\Seeders;

use App\Models\Personas; // namespace correcto para el modelo de Personas
use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personas::factory()
            ->count(10)
            ->create();
    }
}
