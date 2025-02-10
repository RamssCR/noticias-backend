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
            $table->string('titulo', 75);
            $table->string('descripcion', 250);
            $table->string('introduccion', 250);
            $table->longText('contenido');
            $table->longText('nudo');
            $table->longText('desenlace');
            $table->string('autor', 45);
            $table->longText('referencia');
            $table->string('fecha_publicacion', 45);
            $table->tinyInteger('estatus')->default(0);
            $table->string('multimedia');
            $table->string('multimedia_introduccion', 250)->nullable();
            $table->string('multimedia_nudo', 250)->nullable();
            $table->string('multimedia_desenlace', 250)->nullable();
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
