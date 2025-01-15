<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Categoria::factory(3)->create();
        Etiqueta::factory(5)->create();
        User::factory(10)->create();
        Noticia::factory(50)->create();
    }
}
