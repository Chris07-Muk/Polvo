<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Roles extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id_rol';
    protected $returnType = "object";
    protected $allowedFields    = [
        'nombre_rol'
    ];
}
