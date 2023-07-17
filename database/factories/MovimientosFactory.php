<?php

namespace Database\Factories;

use App\Models\Movimientos;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovimientosFactory extends Factory
{
    protected $model = Movimientos::class;

    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'operacion' => $this->faker->randomElement(['A', 'D']),
            'concepto' => $this->faker->randomElement([
                'Pago en Comercio On-Line',
                'Pago en gasolinera',
                'Pago en restaurantes',
                'Pago en supermercado',
                'Pago de reparaciones'
            ]),            'puntos' => $this->faker->numberBetween(1, 1000), // Número aleatorio entre 1 y 1000
            'saldomov' => $this->faker->numberBetween(1, 1000), // Número aleatorio entre 1 y 1000
            'tarjeta' => '1234567890123456', // Igual que en tu ejemplo
            'localizador' => $this->faker->bothify('??###??'), // Generará una cadena alfanumérica aleatoria como 'AB123CD'
            'comercio' => $this->faker->randomElement([
                'El Libro Feliz',
                'Supermercado Todo Barato',
                'Restaurante Delicias',
                'Reparaciones Rápidas',
                'Gasolinera El Rápido',
                'Tienda de Electrónica Moderna',
                'Ropa para Todos',
                'Zapatería Pasos Ligeros'
            ]),

            'comentarios' => $this->faker->sentence(10),
            'cuenta_id' => null, // Este campo será llenado cuando creamos el Movimiento
        ];
    }
}

