<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('id_noticias');
            $table->string('titulo', 150);
            $table->string('descripcion', 45);
            $table->longText('contenido');
            $table->string('autor', 45);
            $table->string('fecha_publicacion', 45);
            $table->tinyInteger('estatus')->default(0);
            $table->string('multimedia');
            $table->tinyInteger('deshabilitado')->default(0);
            $table->foreignId('id_categoria')->unsigned()->constrained('categorias', 'id_categoria');
            $table->foreignId('id_etiqueta')->unsigned()->constrained('etiquetas', 'id_etiqueta');
            $table->foreignId('id_usuario')->unsigned()->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
