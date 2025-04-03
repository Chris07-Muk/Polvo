<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_UsuariosPlanes extends Model
{
    protected $table            = 'usuarios_planes';
    protected $primaryKey       = 'id_usuario_plan';
    protected $allowedFields    = [
        'fecha_registro_plan',
        'fecha_fin_plan',
        'id_usuario',
        'id_plan'
    ];



    public function get_usuarios_planes()
    {
        return $this->db->table('usuarios_planes up')
            ->select('up.*, 
                  CONCAT(u.nombre_usuario, " ", u.ap_usuario, " ", u.am_usuario) AS nombre_usuario,
                  u.email_usuario AS correo_usuario,
                  p.nombre_plan,
                  p.precio_plan')
            ->join('usuarios u', 'u.id_usuario = up.id_usuario')
            ->join('planes p', 'p.id_plan = up.id_plan')
            ->get()
            ->getResultArray(); // Puedes usar ->getResult() si prefieres objetos
    }


    public function plan_usuario($id_usuario)
{
    return $this->db->table('usuarios_planes up')
        ->select('
            up.id_usuario, up.id_plan,
            CONCAT(u.nombre_usuario, " ", u.ap_usuario, " ", u.am_usuario) AS nombre_usuario,
            u.email_usuario AS correo_usuario,
            p.nombre_plan,
            p.precio_plan,
            p.cantidad_limite_plan,
            p.tipo_plan, 
            up.fecha_registro_plan,
            up.fecha_fin_plan,
            DATEDIFF(up.fecha_fin_plan, up.fecha_registro_plan) AS dias_activo')
        ->join('usuarios u', 'u.id_usuario = up.id_usuario')
        ->join('planes p', 'p.id_plan = up.id_plan')
        ->where('u.id_usuario', $id_usuario)
        ->orderBy('up.fecha_registro_plan', 'DESC')
        ->limit(1)
        ->get()
        ->getRow();
}

    

    public function ultimo_pago_usuario($id_usuario)
    {
        return $this->where('id_usuario', $id_usuario)
                    ->orderBy('fecha_registro_pago', 'DESC')
                    ->first(); // El más reciente
    }
}
