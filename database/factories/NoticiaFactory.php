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
            'introduccion' => $this->faker->sentence(10),
            'descripcion' => $this->faker->sentence(6),
            'contenido' => $this->faker->paragraph,
            'nudo' => $this->faker->paragraph,
            'desenlace' => $this->faker->paragraph,
            'autor' => $this->faker->randomElement(['Fabian Scott', 'Henry Tyrell', 'Margary Quinn', 'Josie Pourle', 'Javier Oviedo']),
            'referencia' => $this->faker->url,
            'fecha_publicacion' => $this->faker->date('d/m/Y'),
            'multimedia' => 'multimedia/8NiLZ9AXqYJOtd9ubA2RZFC63FuUP0U2sRWQrAFZ.jpg',
            'multimedia_introduccion' => 'multimedia/' . $this->faker->image('public/storage/multimedia', 640, 480, null, false),
            'multimedia_nudo' => 'multimedia/' . $this->faker->image('public/storage/multimedia', 640, 480, null, false),
            'multimedia_desenlace' => 'multimedia/' . $this->faker->image('public/storage/multimedia', 640, 480, null, false),
            'estatus' => $this->faker->randomElement([0, 1]),
            'id_categoria' => $this->faker->randomElement([1, 2, 3]),
            'id_etiqueta' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'id_usuario' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        ];
    }
}
