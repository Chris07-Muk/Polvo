<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Streaming extends Model
{
    protected $table            = 'streaming';
    protected $primaryKey       = 'id_streaming';
    protected $returnType = "object";
    protected $allowedFields    = [
        'estatus_streaming',
        'nombre_streaming',
        'fecha_lanzamiento_streaming',
        'duracion_streaming',
        'temporadas_streaming',
        'caratula_streaming',
        'trailer_streaming',
        'clasificacion_streaming',
        'sipnosis_streaming',
        'fecha_estreno_streaming',
        'id_genero'
    ];
}
