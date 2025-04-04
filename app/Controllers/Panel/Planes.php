<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Planes;

class Planes extends BaseController
{
    private $view = 'panel/planes';
    private $session = null;
    private $permiso = true;

    public function __construct()
    {
        $this->session = session();
        helper('message');
        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_PLANES, $this->session->rol_actual ?? null)) {
            $this->permiso = false;
        }

        $this->session->tarea_actual = TAREA_PLANES;
    }

    private function create_view($nombreVista = '', $contenido = [])
{
    $contenido["menu_lateral"] = crear_menu_panel($this->session->tarea_actual ?? '', $this->session->rol_actual ?? '');
    return view($nombreVista, $contenido);
}


    private function load_data()
{
    $data['titulo_pagina'] = 'Planes';
    $data['nombre_pagnia'] = 'Gestión de Planes';
    $data['nombre_completo_usuario'] = $this->session->nombre_completo ?? '';
    $data['nombre_usuario'] = $this->session->nickname ?? '';
    $data['email_usuario'] = $this->session->correo ?? '';
    $data['imagen_usuario'] = $this->session->perfil ?? (($this->session->sexo ?? '') == MASCULINO ? 'HOMBRE.jpeg' : 'MUJER.jpeg');

    $breadcrumb = [
        ['href' => route_to('planes'), 'titulo' => 'Planes'],
    ];
    $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

    return $data;
}


    public function inicio()
    {
        if ($this->permiso) {
            $data = $this->load_data();
            $modelo = new Tabla_Planes();
            $data['planes'] = $modelo->findAll();
            return $this->create_view($this->view, $data);
        } else {
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }
    }

    public function agregar()
    {
        $data = $this->load_data();
        $data['titulo_pagina'] = 'Nuevo Plan';
        return $this->create_view('panel/planes_nuevo', $data);
    }

    public function registrar()
{
    $modelo = new Tabla_Planes();

    $tipo = $this->request->getPost('tipo');

    // Validar que el tipo sea uno de los permitidos
    $tiposPermitidos = [8, 16, 32];
    if (!in_array((int)$tipo, $tiposPermitidos)) {
        make_message(ERROR_ALERT, 'Tipo de plan inválido.', 'Error');
        return redirect()->to(route_to('planes'));
    }

    $datos = [
        'estatus_plan' => 1,
        'nombre_plan' => $this->request->getPost('nombre'),
        'precio_plan' => $this->request->getPost('precio'),
        'cantidad_limite_plan' => $this->request->getPost('cantidad'),
        'tipo_plan' => (int)$tipo,
    ];

    if ($modelo->insert($datos)) {
        make_message(SUCCESS_ALERT, 'Plan registrado exitosamente.', 'Éxito');
    } else {
        make_message(ERROR_ALERT, 'No se pudo registrar el plan.', 'Error');
    }

    return redirect()->to(route_to('planes'));
}


    public function editar($id = 0)
    {
        $modelo = new Tabla_Planes();
        $plan = $modelo->find($id);

        if (!$plan) {
            make_message(ERROR_ALERT, 'Plan no encontrado.', 'Error');
            return redirect()->to(route_to('planes'));
        }

        $data = $this->load_data();
        $data['plan'] = $plan;
        $data['titulo_pagina'] = 'Editar Plan';

        return $this->create_view('panel/planes_editar', $data);
    }

    public function actualizar($id = 0)
{
    $modelo = new Tabla_Planes();
    $plan = $modelo->find($id);

    if (!$plan) {
        make_message(ERROR_ALERT, 'Plan no encontrado.', 'Error');
        return redirect()->to(route_to('planes'));
    }

    $tipo = $this->request->getPost('tipo');
    $tiposPermitidos = [8, 16, 32];
    if (!in_array((int)$tipo, $tiposPermitidos)) {
        make_message(ERROR_ALERT, 'Tipo de plan inválido.', 'Error');
        return redirect()->to(route_to('planes'));
    }

    $datos = [
        'nombre_plan' => $this->request->getPost('nombre'),
        'precio_plan' => $this->request->getPost('precio'),
        'cantidad_limite_plan' => $this->request->getPost('cantidad'),
        'tipo_plan' => (int)$tipo,
    ];

    if ($modelo->update($id, $datos)) {
        make_message(SUCCESS_ALERT, 'Plan actualizado exitosamente.', 'Éxito');
    } else {
        make_message(ERROR_ALERT, 'No se pudo actualizar el plan.', 'Error');
    }

    return redirect()->to(route_to('planes'));
}


    public function eliminar($id = 0)
    {
        $modelo = new Tabla_Planes();

        if ($modelo->find($id)) {
            $modelo->delete($id);
            make_message(SUCCESS_ALERT, 'Plan eliminado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Plan no encontrado.', 'Error');
        }

        return redirect()->to(route_to('planes'));
    }

    public function cambiar_estatus($id = 0, $estatus = 1)
    {
        $modelo = new Tabla_Planes();

        if ($modelo->find($id)) {
            $modelo->update($id, ['estatus_plan' => $estatus]);
            make_message(SUCCESS_ALERT, 'Estatus actualizado correctamente.', 'Éxito');
        } else {
            make_message(ERROR_ALERT, 'Plan no encontrado.', 'Error');
        }

        return redirect()->to(route_to('planes'));
    }
}
