<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use App\Models\Tabla_usuario;

class Nuevo_Usuario_Portal extends BaseController
{
    private $view = 'usuario/nuevo_usuario_portal';
    private $session = null;

    public function __construct()
    {
        $this->session = session();
        helper(['form', 'url', 'message']);
    }

    private function load_data()
    {
        // Array para los datos
        $data = [];
        // Datos generales de la página
        $data['titulo_pagina'] = 'Registro de Usuario';

        $data['is_logged'] = $this->session->get('is_logged');
        $data['nombre_completo_usuario'] = $this->session->get('nombre_completo');
        $data['nombre_usuario'] = $this->session->get('nickname');
        $data['email_usuario'] = $this->session->get('correo');
        $data['imagen_usuario'] = ($this->session->get('perfil') == null)
            ? (($this->session->get('sexo') == 'M') ? 'HOMBRE.jpeg' : 'MUJER.jpeg')
            : $this->session->get('perfil');

        return $data;
    }

    private function create_view($name_view = '', $content = array())
    {
        return view($name_view, $content);
    }

    public function index()
    {
        return $this->create_view($this->view, $this->load_data());
    }

    public function registrar()
    {
        helper(['message', 'filesystem']);

        $usuario = [];
        $usuario['estatus_usuario'] = 0; 
        $usuario['nombre_usuario'] = $this->request->getPost('nombre');
        $usuario['ap_usuario'] = $this->request->getPost('apellido_paterno');
        $usuario['am_usuario'] = $this->request->getPost('apellido_materno');
        $usuario['sexo_usuario'] = $this->request->getPost('sexo');
        $usuario["email_usuario"] = $this->request->getPost("email");
        $usuario['password_usuario'] = hash('sha256', $this->request->getPost('password'));
        $usuario['id_rol'] = 58; 

        $imagen = $this->request->getFile('foto_perfil');

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nuevoNombre = $imagen->getRandomName();
            $rutaDestino = FCPATH . 'perfiles/';
            $imagen->move($rutaDestino, $nuevoNombre);
            $usuario['imagen_usuario'] = $nuevoNombre;
        } else {
            $usuario['imagen_usuario'] = null;
        }

        $tabla_usuarios = new Tabla_usuario();

        if ($tabla_usuarios->insert($usuario)) {
            make_message(SUCCESS_ALERT, 'Te has registrado correctamente. Espera activación del administrador.', '¡Listo!');
            return redirect()->to(route_to('portal'));
        } else {
            make_message(ERROR_ALERT, 'No se pudo completar tu registro.', 'Error');
            return redirect()->back()->withInput();
        }
    }
}