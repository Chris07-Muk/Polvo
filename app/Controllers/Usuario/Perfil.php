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

    private function load_data(){
        $data = array();
        $data['nombre_pagina'] = 'Perfil';
        $data['titulo_pagina'] = 'Perfil usuario';

        $id_usuario = $this->session->get('id_usuario');

        // Obtener datos actualizados del plan desde la base
        $modelo_planes = new Tabla_UsuariosPlanes();
        $plan = $modelo_planes->plan_usuario($id_usuario);

        $data["nombre_completo_usuario"] = $this->session->get('nombre_completo');
        $data["nombre_usuario"] = $this->session->get('nickname');
        $data["nombre_completo"] = $this->session->get('nombre_completo');
        $data["email_usuario"] = $this->session->get('correo');
        $data["imagen_usuario"] = ($this->session->get('perfil') == NULL) 
                                    ? (($this->session->get('sexo') == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg') 
                                    : $this->session->get('perfil');
        $data["is_logged"] = $this->session->get('is_logged');
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
