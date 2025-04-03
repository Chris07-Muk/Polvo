<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Videos extends Model
{
    protected $table            = 'videos';
    protected $primaryKey       = 'id_video';
    protected $returnType = "object";
    protected $allowedFields    = [
        'estatus_video',
        'video',
        'nombre_temporada',
        'video_temporada',
        'capitulo_temporada',
        'descripcion_capitulo_temporada',
        'id_streaming'
    ];
}
