<?php

namespace Database\Factories;

use App\Models\Etiqueta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etiqueta>
 */
class EtiquetaFactory extends Factory
{
    protected $model = Etiqueta::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Nuevo', 'Popular', 'Antiguo', 'Desmentido', 'Tendencia'])
        ];
    }
}
