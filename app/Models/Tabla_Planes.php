<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Planes extends Model
{
    protected $table            = 'planes';
    protected $primaryKey       = 'id_plan';
    protected $returnType = "object";
    protected $allowedFields    = [
        'estatus_plan',
        'nombre_plan',
        'precio_plan',
        'cantidad_limite_plan',
        'tipo_plan'
    ];
}
