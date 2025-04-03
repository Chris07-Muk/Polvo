<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    private $view = 'panel/dashboard';
    //private $view = 'panel/dashboard2';
    private $session = null;
    private $permiso = TRUE;

    public function __construct(){
        //instanciamos la variable de sesion
        $this->session = session();

        //Instancia del permisos herlper
        helper("permisos_roles_helper");
        if (!acceso_usuario(TAREA_DASHBOARD, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }//end if
        $this->session->tarea_actual = TAREA_DASHBOARD;

    }

    private function load_data(){
        //load helper
        helper('message');
        $data = array();
        //Datos Globales - menulateral, header, foother, session
        $data['nombre_pagnia'] = 'Dashboard';
        $data['titulo_pagina'] = 'Dashboard';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        //RECURSOS_PANEL_IMG_PROFILES_USER
        $data["imagen_usuario"] = ($this->session->perfil == NULL) 
                                    ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg') 
                                    : $this->session->perfil;

        $breadcrumb = array(
            array(
                'href' => route_to("dashboard"),
                'titulo' => 'Dashboard',
            ),
            array(
                'href' => '#',
                'titulo' => 'Dashboard',
            )
        );
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        //Queries SQL
        return $data;
    }//end load_data

    private function create_view($name_view = '', $content = array()){
        $content["menu_lateral"] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($name_view, $content);
    }//end make_view

    //Main function : index
    public function index()
    {
        if ($this->permiso) {
            return $this->create_view($this->view, $this->load_data());
        }//end if
        else {
            helper('message');
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este modulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }
    }// end index


}// end Dashboard
