<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Alquileres extends Model
{
    protected $table            = 'alquileres';
    protected $primaryKey       = 'id_alquiler';
    protected $returnType = "object";
    
    protected $allowedFields    = [
        'fecha_inicio_alquiler',
        'fecha_fin_alquiler',
        'estatus_alquiler',
        'id_streaming',
        'id_usuario',
        'id_pago'
    ];

    public function getWithRelations()
{
    return $this->select('alquileres.*, usuarios.nombre_usuario, usuarios.ap_usuario, streaming.nombre_streaming')
        ->join('usuarios', 'usuarios.id_usuario = alquileres.id_usuario')
        ->join('streaming', 'streaming.id_streaming = alquileres.id_streaming')
        ->findAll();
}

}
