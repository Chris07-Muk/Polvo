<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_UsuariosPlanes;
use App\Models\Tabla_usuario;
use App\Models\Tabla_Planes;

class Usuarios_Planes extends BaseController
{
    private $view = 'panel/usuarios_planes';
    private $session = null;
    private $permiso = true;

    public function __construct()
    {
        $this->session = session();
        helper('message');
        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_USUARIOS_PLANES, $this->session->rol_actual ?? null)) {
            $this->permiso = false;
        }

        $this->session->tarea_actual = TAREA_USUARIOS_PLANES;
    }

    private function create_view($nombreVista = '', $contenido = [])
    {
        $contenido["menu_lateral"] = crear_menu_panel($this->session->tarea_actual ?? '', $this->session->rol_actual ?? '');
        return view($nombreVista, $contenido);
    }

    private function load_data()
    {
        $data['titulo_pagina'] = 'Asignación de Planes';
        $data['nombre_pagnia'] = 'Gestión de Planes de Usuarios';
        $data['nombre_completo_usuario'] = $this->session->nombre_completo ?? '';
        $data['nombre_usuario'] = $this->session->nickname ?? '';
        $data['email_usuario'] = $this->session->correo ?? '';
        $data['imagen_usuario'] = $this->session->perfil ?? (($this->session->sexo ?? '') == MASCULINO ? 'HOMBRE.jpeg' : 'MUJER.jpeg');

        $breadcrumb = [
            ['href' => route_to('usuarios_planes'), 'titulo' => 'Planes de Usuarios'],
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        return $data;
    }

    public function index()
    {
        if ($this->permiso) {
            $data = $this->load_data();
            $modelo = new Tabla_UsuariosPlanes();
$data['usuarios_planes'] = $modelo->get_usuarios_planes(); // antes era findAll()

            return $this->create_view($this->view, $data);
        } else {
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }
    }

    public function nuevo()
    {
        $data = $this->load_data();
        $data['titulo_pagina'] = 'Nuevo Registro de Plan';

        $modeloUsuarios = new Tabla_usuario();
        $modeloPlanes = new Tabla_Planes();

        $usuarios = $modeloUsuarios->findAll();
        foreach ($usuarios as $usuario) {
            $usuario->nombre_completo = trim($usuario->nombre_usuario . ' ' . $usuario->ap_usuario . ' ' . $usuario->am_usuario);
        }

        $data['usuarios'] = $usuarios;
        $data['planes'] = $modeloPlanes->findAll();

        return $this->create_view('panel/usuarios_planes_nuevo', $data);
    }

    public function guardar()
    {
        $modelo = new Tabla_UsuariosPlanes();

        $datos = [
            'fecha_registro_plan' => $this->request->getPost('fecha_registro'),
            'fecha_fin_plan' => $this->request->getPost('fecha_fin'),
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_plan' => $this->request->getPost('id_plan')
        ];

        if ($modelo->insert($datos)) {
            make_message(SUCCESS_ALERT, 'Registro asignado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Error al asignar plan.', 'Error');
        }

        return redirect()->to(route_to('usuarios_planes'));
    }

    public function editar($id = 0)
    {
        $modelo = new Tabla_UsuariosPlanes();
    
        // Buscar el registro como objeto (por defecto)
        $registro = $modelo->find($id); // returnType = 'object'
    
        if (!$registro) {
            make_message(ERROR_ALERT, 'Registro no encontrado.', 'Error');
            return redirect()->to(route_to('usuarios_planes'));
        }
    
        $data = $this->load_data();
        $data['registro'] = $registro;
        $data['titulo_pagina'] = 'Editar Registro de Plan';
    
        $modeloUsuarios = new Tabla_usuario();
        $modeloPlanes = new Tabla_Planes();
    
        // Obtener usuarios como objetos y construir nombre completo
        $usuarios = $modeloUsuarios->findAll();
        foreach ($usuarios as $usuario) {
            $usuario->nombre_completo = trim(
                $usuario->nombre_usuario . ' ' .
                $usuario->ap_usuario . ' ' .
                $usuario->am_usuario
            );
        }
    
        $data['usuarios'] = $usuarios;
        $data['planes'] = $modeloPlanes->findAll(); // también como objetos
    
        return $this->create_view('panel/usuarios_planes_editar', $data);
    }
    


    public function actualizar($id = 0)
    {
        $modelo = new Tabla_UsuariosPlanes();
        $registro = $modelo->find($id);

        if (!$registro) {
            make_message(ERROR_ALERT, 'Registro no encontrado.', 'Error');
            return redirect()->to(route_to('usuarios_planes'));
        }

        $datos = [
            'fecha_registro_plan' => $this->request->getPost('fecha_registro'),
            'fecha_fin_plan' => $this->request->getPost('fecha_fin'),
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_plan' => $this->request->getPost('id_plan')
        ];

        if ($modelo->update($id, $datos)) {
            make_message(SUCCESS_ALERT, 'Registro actualizado.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar.', 'Error');
        }

        return redirect()->to(route_to('usuarios_planes'));
    }

    public function eliminar($id = 0)
    {
        $modelo = new Tabla_UsuariosPlanes();

        if ($modelo->find($id)) {
            $modelo->delete($id);
            make_message(SUCCESS_ALERT, 'Registro eliminado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Registro no encontrado.', 'Error');
        }

        return redirect()->to(route_to('usuarios_planes'));
    }
}
