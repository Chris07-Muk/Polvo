<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_Generos extends Model
{
    protected $table            = 'generos';
    protected $primaryKey       = 'id_genero';
    protected $returnType       = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'estatus_genero',
        'nombre_genero',
        'descripcion_genero'
    ];

    // Obtener todos los géneros
    public function get_all()
    {
        return $this->orderBy('id_genero', 'DESC')->findAll();
    }

    // Obtener un género por ID
    public function get_by_id($id = 0)
    {
        return $this->where('id_genero', $id)->first();
    }

    // Crear género
    public function create($data = [])
    {
        return $this->insert($data);
    }

    // Actualizar género
    public function update_data($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar género
    public function delete_data($id)
    {
        return $this->delete($id);
    }
}
