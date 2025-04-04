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
    public function get_recientes($limite = 3)
    {
        return $this->db->table($this->table)
            ->where('estatus_streaming', 1)
            ->orderBy('id_streaming', 'DESC')
            ->limit($limite)
            ->get()
            ->getResult();
    }
}
