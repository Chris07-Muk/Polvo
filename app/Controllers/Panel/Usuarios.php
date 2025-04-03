<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;

class Usuarios extends BaseController
{
    private $view = 'panel/usuarios';
    //private $view = 'panel/dashboard2';
    private $session = null;
    private $permiso = TRUE;

    public function __construct(){
        //instanciamos la variable de sesion
        $this->session = session();

        //Instancia del permisos herlper
        helper("permisos_roles_helper");
        if (!acceso_usuario(TAREA_USUARIOS, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }//end if
        $this->session->tarea_actual = TAREA_USUARIOS;

    }

    private function load_data(){
        //load helper
        helper('message');
        $data = array();
        //Datos Globales - menulateral, header, foother, session
        $data['nombre_pagnia'] = 'Usuarios';
        $data['titulo_pagina'] = 'Usuarios';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        //RECURSOS_PANEL_IMG_PROFILES_USER
        $data["imagen_usuario"] = ($this->session->perfil == NULL) 
                                    ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg') 
                                    : $this->session->perfil;

        $breadcrumb = array(
            array(
                'href' => route_to("usuarios"),
                'titulo' => 'Usuarios',
            ),
            array(
                'href' => '#',
                'titulo' => 'Usuarios',
            )
        );
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        //Queries SQL

        $tabla_usuarios = new \App\Models\Tabla_usuario;

        $data["usuarios"] = $tabla_usuarios->get_table();

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

    public function estatus($id_usuario = 0, $estatus = FALSE){
        helper('message');
        //Instaciamos el modelo
        $tabla_usuarios = new \App\Models\Tabla_usuario;
        if ($tabla_usuarios->find($id_usuario) != null) {
            //update query
            if ($tabla_usuarios->update_data($id_usuario, ["estatus_usuario" => $estatus])) {
                make_message(SUCCESS_ALERT, 'Actualizacion éxitosa del estatus del usuario.', 'Éxito!');
            }//end if
            else {
                make_message(ERROR_ALERT, 'Error al actualizar el estatus del usuario.', 'Error');
            }
        }//end if
        else {
            make_message(ERROR_ALERT, 'El usuario que solicitas no se ha encontrado.', 'Error');
            //return $this->create_view($this->view, $this->load_data($id_usuario));
        }//end else
        return redirect()->to(route_to("usuarios"));
    }//end estatus

    public function eliminar($id_usuario = 0){
        helper('message');
        //Instaciamos el modelo
        $tabla_usuarios = new \App\Models\Tabla_usuario;
        if ($tabla_usuarios->find($id_usuario) != null) {
            //delete query
            if ($tabla_usuarios->delete_data($id_usuario)) {
                make_message(SUCCESS_ALERT, 'El usuario se elimino correctamente.', 'Éxito!');
            }//end if
            else {
                make_message(ERROR_ALERT, 'Error al eliminar el usuario.', 'Error');
            }
        }//end if
        else {
            make_message(ERROR_ALERT, 'El usuario que solicitas no se ha encontrado.', 'Error');
            //return $this->create_view($this->view, $this->load_data($id_usuario));
        }//end else
        return redirect()->to(route_to("usuarios"));

    }//end eliminar

}// end Dashboard
