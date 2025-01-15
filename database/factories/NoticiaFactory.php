<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    protected $model = Noticia::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(6),
            'contenido' => $this->faker->sentence(11),
            'autor' => $this->faker->randomElement(['Fabian Scott', 'Henry Tyrell', 'Margary Quinn', 'Josie Pourle', 'Javier Oviedo']),
            'fecha_publicacion' => '01/01/2025',
            'multimedia' => 'multimedia/8NiLZ9AXqYJOtd9ubA2RZFC63FuUP0U2sRWQrAFZ.jpg',
            'estatus' => $this->faker->randomElement([0, 1]),
            'id_categoria' => $this->faker->randomElement([1, 2, 3]),
            'id_etiqueta' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'id_usuario' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        ];
    }
}
