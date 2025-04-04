<?php

namespace App\Controllers\Usuario;
use App\Controllers\BaseController;
use App\Models\Tabla_UsuariosPlanes;

class Perfil extends BaseController
{
    private $view = 'usuario/perfil';
    private $session = null;

    public function __construct()
    {
        $this->session = session();
    }

    private function load_data() {
        // Inicializar array de datos
        $data = [
            'nombre_pagina' => 'Perfil',
            'titulo_pagina' => 'Perfil usuario',
            'is_logged' => $this->session->get('is_logged')
        ];
    
        // Obtener datos del usuario desde sesión
        $data["nombre_completo_usuario"] = $this->session->get('nombre_completo');
        $data["nombre_usuario"] = $this->session->get('nickname');
        $data["nombre_completo"] = $data["nombre_completo_usuario"]; 
        $data["email_usuario"] = $this->session->get('correo');
    
        // Determinar imagen de perfil
        $imagenPerfil = $this->session->get('perfil');
        $data["imagen_usuario"] = $imagenPerfil ?? 
                                 (($this->session->get('sexo') == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg');
    
        // Obtener datos del plan
        $id_usuario = $this->session->get('id_usuario');
        $plan = (new Tabla_UsuariosPlanes())->plan_usuario($id_usuario);
        
        $data["nombre_plan"] = $plan ? $plan->nombre_plan : 'Sin plan';
        $data["dias_activo"] = $plan ? $plan->dias_activo : 0;
    
        helper('message');
    
        return $data;
    }

    private function create_view($name_view = '', $content = array()){
        return view($name_view, $content);
    }

    public function index()
    {
        if(!$this->session->get('is_logged')){
            return redirect()->to(route_to("portal"));
        }
        return $this->create_view($this->view, $this->load_data());
    }
}
