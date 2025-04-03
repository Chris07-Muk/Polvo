<?php
namespace App\Models;
use CodeIgniter\Model;

class Tabla_usuario extends Model{
    protected $table = "usuarios";
    protected $primaryKey = "id_usuario";
    protected $useAutoIncrement = TRUE;
    protected $returnType = "object";
    protected $allowedFields = ["id_usuario", "estatus_usuario", "nombre_usuario",
                                "ap_usuario", "am_usuario", "sexo_usuario", "email_usuario",
                                "password_usuario", "imagen_usuario", "id_rol"];
    
    //=============================
    //Consultas basicas
    //Create, Read, Update, Delete
    //=============================

    public function create_data($data){
        // Map correo_usuario to email_usuario if present
        if (isset($data['correo_usuario'])) {
            $data['email_usuario'] = $data['correo_usuario'];
            unset($data['correo_usuario']);
        }
        
        if (!empty($data)){
            return $this
                ->table($this->table)
                ->insert($data);
        }//end if
        else {
            return FALSE;
        }
    }//end create_data

    public function get_user($contraints = array()){
        // Map correo_usuario to email_usuario if present
        if (isset($contraints['correo_usuario'])) {
            $contraints['email_usuario'] = $contraints['correo_usuario'];
            unset($contraints['correo_usuario']);
        }
        
        $result = $this
                ->table($this->table)
                ->where($contraints)
                ->get()
                ->getRow();
                
        // Add correo_usuario property if the row exists
        if ($result && isset($result->email_usuario)) {
            $result->correo_usuario = $result->email_usuario;
        }
        
        return $result;
    }//end get_user

    
    
    public function update_data($id = 0, $data = array()){
        // Map correo_usuario to email_usuario if present
        if (isset($data['correo_usuario'])) {
            $data['email_usuario'] = $data['correo_usuario'];
            unset($data['correo_usuario']);
        }
        
        if (!empty($data)){
            return $this
                ->table($this->table)
                ->where([$this->primaryKey => $id])
                ->set($data)
                ->update();
        }//end if
        else {
            return FALSE;
        }
    }//end update_data

    public function verificar_usuario($email = null, $password = null){
        $result = $this
                ->from($this->table." AS u")
                ->select("u.id_usuario, CONCAT(u.nombre_usuario,' ',u.ap_usuario,' ',u.am_usuario) AS nombre_completo, 
                u.nombre_usuario AS usuario, u.sexo_usuario, u.estatus_usuario, u.email_usuario AS correo, 
                u.imagen_usuario AS imagen, u.id_rol, r.nombre_rol")
                ->join('roles r', 'u.id_rol = r.id_rol')
                ->where('u.email_usuario', $email)
                ->where('u.password_usuario', $password)
                ->first();
                
        // Add correo_usuario property if the result exists
        if ($result && isset($result->correo)) {
            $result->correo_usuario = $result->correo;
        }
        
        return $result;
    }//end verificar_usuario
    
    public function delete_data($id = 0){
        if (!empty($id)){
            return $this
                ->table($this->table)
                ->where([$this->primaryKey => $id])
                ->delete();
        }//end if
        else {
            return FALSE;
        }
    }

    public function get_table() {
        
    return $this
        ->select('usuarios.*, roles.nombre_rol')
        ->join('roles', 'roles.id_rol = usuarios.id_rol')
        ->findAll();

    }
    
    public function obtener_clientes()
{
    return $this->where('id_rol', ROL_CLIENTE['clave'])->findAll();
}


}//end Tabla_usuario