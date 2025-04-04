<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;

class Usuario_nuevo extends BaseController
{
    private $view = 'panel/usuario_nuevo';
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
        helper('message');
        $data = [];
    
        $data['nombre_pagnia'] = 'Usuarios';
        $data['titulo_pagina'] = 'Usuarios';
        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
    
        $data["imagen_usuario"] = ($this->session->perfil == NULL) 
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg') 
            : $this->session->perfil;
    
        $breadcrumb = [
            ['href' => route_to("usuarios"), 'titulo' => 'Usuarios'],
            ['href' => '#', 'titulo' => 'Usuario nuevo']
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);
    
        // ✅ Cargar los roles desde la tabla
        $modeloRoles = new \App\Models\Tabla_roles(); // Asegúrate de tener este modelo creado
        $data['roles'] = $modeloRoles->findAll();
    
        return $data;
    }
    

    private function create_view($name_view = '', $content = array()){
        $content["menu_lateral"] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($name_view, $content);
    }//end make_view

    //Main function : index
    public function inicio()
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

    public function agregar()
{
    helper(['message', 'filesystem']);

    $usuario = [];

    $usuario["estatus_usuario"] = ESTATUS_HABILITADO;
    $usuario["nombre_usuario"] = $this->request->getPost("nombre");
    $usuario["ap_usuario"] = $this->request->getPost("apellido_paterno");
    $usuario["am_usuario"] = $this->request->getPost("apellido_materno");
    $usuario["sexo_usuario"] = $this->request->getPost("sexo");
    $usuario["correo_usuario"] = $this->request->getPost("email");
    $usuario["password_usuario"] = hash("sha256", $this->request->getPost("password"));
    $usuario["id_rol"] = $this->request->getPost("rol");

    // === Subida de imagen ===
    $imagen = $this->request->getFile('foto_perfil');

    if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
        $nuevoNombre = $imagen->getRandomName();
        $rutaDestino = FCPATH . 'perfiles/'; // Ya apunta a public/perfiles/

        $imagen->move($rutaDestino, $nuevoNombre);

        $usuario["imagen_usuario"] = $nuevoNombre;
    } else {
        $usuario["imagen_usuario"] = null; // o pon una imagen por defecto si prefieres
    }

    // === Guardar en la base de datos ===
    $tabla_usuarios = new \App\Models\Tabla_usuario;

    if ($tabla_usuarios->create_data($usuario) > 0) {
        make_message(SUCCESS_ALERT, 'Se ha registrado el usuario correctamente.', 'Éxito!');
        return redirect()->to(route_to("usuarios"));
    } else {
        make_message(ERROR_ALERT, 'Error al registrar el usuario.', 'Error!');
        return redirect()->to(route_to("usuario_nuevo"));
    }
}



}// end Dashboard
