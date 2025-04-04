<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;

class Usuario_detalles extends BaseController
{
    private $view = 'panel/usuario_detalles';
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

    private function load_data($id_usuario = 0){
        //load helper
        helper('message');
        $data = array();
        //Datos Globales - menulateral, header, foother, session
        $data['nombre_pagnia'] = 'Usuario detalles';
        $data['titulo_pagina'] = 'Usuario detalles';

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
                'titulo' => 'Usuario detalles',
            )
        );
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        //Queries SQL
        //Instaciamos el modelo
        $tabla_usuarios = new \App\Models\Tabla_usuario;
        $data['usuario'] = $tabla_usuarios->get_user(["id_usuario" => $id_usuario]);
        // dd($data['usuario']);

        return $data;
    }//end load_data

    private function create_view($name_view = '', $content = array()){
        $content["menu_lateral"] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($name_view, $content);
    }//end make_view

    //Main function : index
    public function inicio($id_usuario = 0)
    {
        helper('message');
        if ($this->permiso) {

            //Instaciamos el modelo
            $tabla_usuarios = new \App\Models\Tabla_usuario;
            if ($tabla_usuarios->find($id_usuario) == null) {
                make_message(ERROR_ALERT, 'El usuario que solicitas no se ha encontrado.', 'Error');
                return redirect()->to(route_to("usuarios"));
            }//end if
            else {
                return $this->create_view($this->view, $this->load_data($id_usuario));
            }//end else
        }//end if
        else {
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este modulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }
    }// end index

    public function actualizar($id_usuario = 0)
    {
        helper(['message', 'filesystem']);
    
        $tabla_usuarios = new \App\Models\Tabla_usuario;
    
        if ($tabla_usuarios->find($id_usuario) != null) {
            $usuario = [];
    
            $usuario["estatus_usuario"] = ESTATUS_HABILITADO;
            $usuario["nombre_usuario"] = $this->request->getPost("nombre");
            $usuario["ap_usuario"] = $this->request->getPost("apellido_paterno");
            $usuario["am_usuario"] = $this->request->getPost("apellido_materno");
            $usuario["sexo_usuario"] = $this->request->getPost("sexo");
            $usuario["correo_usuario"] = $this->request->getPost("email");
            $usuario["id_rol"] = $this->request->getPost("rol");
    
            // Manejo de contraseña
            if (!empty($this->request->getPost("password"))) {
                if ($this->request->getPost("password") == $this->request->getPost("repassword")) {
                    $usuario["password_usuario"] = hash("sha256", $this->request->getPost("password"));
                } else {
                    make_message(WARNING_ALERT, 'Las contraseñas no coinciden.', 'Error');
                    return $this->index($id_usuario);
                }
            }
    
            // Manejo de imagen
            $imagen = $this->request->getFile('foto_perfil');
            if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
                $nuevoNombre = $imagen->getRandomName();
                $rutaDestino = FCPATH . 'perfiles/'; // public/perfiles/
    
                $imagen->move($rutaDestino, $nuevoNombre);
                $usuario["imagen_usuario"] = $nuevoNombre;
            }
    
            // Actualizar en BD
            if ($tabla_usuarios->update_data($id_usuario, $usuario)) {
                make_message(SUCCESS_ALERT, 'Actualización exitosa.', 'Éxito!');
                return redirect()->to(route_to("usuarios"));
            } else {
                make_message(ERROR_ALERT, 'Error al actualizar los datos.', 'Error');
                return $this->index($id_usuario);
            }
    
        } else {
            make_message(ERROR_ALERT, 'El usuario que deseas actualizar no existe.', 'Error');
            return $this->index($id_usuario);
        }
    }
    
}// end Dashboard
