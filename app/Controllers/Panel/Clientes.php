<?php
namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_usuario;

class Clientes extends BaseController
{
    private $view = 'panel/clientes';
    private $session = null;
    private $permiso = true;

    public function __construct()
    {
        $this->session = session();
        helper(['message', 'permisos_roles_helper']);

        if (!acceso_usuario(TAREA_CLIENTES, $this->session->rol_actual ?? null)) {
            $this->permiso = false;
        }

        $this->session->tarea_actual = TAREA_CLIENTES;
    }

    private function load_data()
    {
        $data['titulo_pagina'] = 'Clientes';
        $data['nombre_pagnia'] = 'Gestión de Clientes';
        $data['nombre_completo_usuario'] = $this->session->nombre_completo ?? '';
        $data['nombre_usuario'] = $this->session->nickname ?? '';
        $data['email_usuario'] = $this->session->correo ?? '';
        $data['imagen_usuario'] = $this->session->perfil ?? (($this->session->sexo ?? '') == MASCULINO ? 'HOMBRE.jpeg' : 'MUJER.jpeg');

        $breadcrumb = [
            ['href' => route_to('clientes'), 'titulo' => 'Clientes']
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        return $data;
    }

    private function create_view($nombreVista = '', $contenido = [])
    {
        $contenido['menu_lateral'] = crear_menu_panel($this->session->tarea_actual ?? '', $this->session->rol_actual ?? '');
        return view($nombreVista, $contenido);
    }

    public function inicio()
    {
        if (!$this->permiso) {
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }

        $modelo = new Tabla_usuario();
        $data = $this->load_data();
        $data['clientes'] = $modelo
            ->where('id_rol', ROL_CLIENTE['clave'])
            ->findAll();

        return $this->create_view($this->view, $data);
    }

    public function agregar()
    {
        $data = $this->load_data();
        $data['titulo_pagina'] = 'Registrar Cliente';
        return $this->create_view('panel/clientes_nuevo', $data);
    }

    public function registrar()
    {
        $modelo = new Tabla_usuario();
        $cliente = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'ap_usuario' => $this->request->getPost('apellido_paterno'),
            'am_usuario' => $this->request->getPost('apellido_materno'),
            'email_usuario' => $this->request->getPost('email'),
            'password_usuario' => hash('sha256', $this->request->getPost('password')),
            'sexo_usuario' => $this->request->getPost('sexo'),
            'estatus_usuario' => ESTATUS_HABILITADO,
            'id_rol' => ROL_CLIENTE['clave']
        ];

        $imagen = $this->request->getFile('foto_perfil');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move(FCPATH . 'perfiles/', $nuevoNombre);
            $cliente['imagen_usuario'] = $nuevoNombre;
        }

        if ($modelo->insert($cliente)) {
            make_message(SUCCESS_ALERT, 'Cliente registrado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Error al registrar cliente.', 'Error');
        }

        return redirect()->to(route_to('clientes'));
    }

    public function editar($id = 0)
    {
        $modelo = new Tabla_usuario();
        $cliente = $modelo->find($id);

        if (!$cliente || $cliente->id_rol != ROL_CLIENTE['clave']) {
            make_message(ERROR_ALERT, 'Cliente no encontrado.', 'Error');
            return redirect()->to(route_to('clientes'));
        }

        $data = $this->load_data();
        $data['cliente'] = $cliente;

        return $this->create_view('panel/clientes_editar', $data);
    }

    public function actualizar($id = 0)
    {
        $modelo = new Tabla_usuario();
        $cliente = $modelo->find($id);

        if (!$cliente || $cliente->id_rol != ROL_CLIENTE['clave']) {
            make_message(ERROR_ALERT, 'Cliente no encontrado.', 'Error');
            return redirect()->to(route_to('clientes'));
        }

        $datos = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'ap_usuario' => $this->request->getPost('apellido_paterno'),
            'am_usuario' => $this->request->getPost('apellido_materno'),
            'email_usuario' => $this->request->getPost('email'),
            'sexo_usuario' => $this->request->getPost('sexo')
        ];

        if (!empty($this->request->getPost('password'))) {
            $datos['password_usuario'] = hash('sha256', $this->request->getPost('password'));
        }

        $imagen = $this->request->getFile('foto_perfil');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move(FCPATH . 'perfiles/', $nuevoNombre);
            $datos['imagen_usuario'] = $nuevoNombre;
        }

        if ($modelo->update($id, $datos)) {
            make_message(SUCCESS_ALERT, 'Cliente actualizado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar cliente.', 'Error');
        }

        return redirect()->to(route_to('clientes'));
    }

    public function eliminar($id = 0)
    {
        $modelo = new Tabla_usuario();
        $cliente = $modelo->find($id);

        if ($cliente && $cliente->id_rol == ROL_CLIENTE['clave']) {
            $modelo->delete($id);
            make_message(SUCCESS_ALERT, 'Cliente eliminado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Cliente no encontrado.', 'Error');
        }

        return redirect()->to(route_to('clientes'));
    }

    public function cambiar_estatus($id = 0)
{
    $modelo = new Tabla_usuario();
    $cliente = $modelo->find($id);

    if (!$cliente || $cliente->id_rol != ROL_CLIENTE['clave']) {
        make_message(ERROR_ALERT, 'Cliente no encontrado.', 'Error');
        return redirect()->to(route_to('clientes'));
    }

    // Cambia el estatus: si está habilitado (1), lo pasa a -1. Si está deshabilitado (-1), lo pasa a 1
    $nuevoEstatus = ($cliente->estatus_usuario == 1) ? -1 : 1;

    if ($modelo->update($id, ['estatus_usuario' => $nuevoEstatus])) {
        make_message(SUCCESS_ALERT, 'Estatus actualizado correctamente.', 'Éxito');
    } else {
        make_message(ERROR_ALERT, 'Error al actualizar estatus.', 'Error');
    }

    return redirect()->to(route_to('clientes'));
}

}
