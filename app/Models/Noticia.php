<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_noticias';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'descripcion',
        'contenido',
        'autor',
        'fecha_publicacion',
        'estatus',
        'deshabilitado',
        'id_categoria',
        'id_etiqueta',
        'id_usuario',
        'multimedia',
    ];
}
