<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Pagos;
use App\Models\Tabla_usuario;
use App\Models\Tabla_Planes;

class Pagos extends BaseController
{
    private $view = 'panel/pagos';
    private $session = null;

    public function __construct()
    {
        $this->session = session();
        helper(['message', 'form', 'permisos_roles_helper']);
        $this->session->tarea_actual = TAREA_PAGOS;
    }

    private function load_data()
{
    $data = [
        'titulo_pagina' => 'Pagos',
        'nombre_pagnia' => 'Gestión de Pagos',
        'nombre_completo_usuario' => $this->session->nombre_completo ?? '',
        'nombre_usuario' => $this->session->nickname ?? '',
        'email_usuario' => $this->session->correo ?? '',
        'imagen_usuario' => $this->session->perfil ?? (($this->session->sexo ?? '') == MASCULINO ? 'HOMBRE.jpeg' : 'MUJER.jpeg'),
    ];

    $breadcrumb = [
        ['href' => route_to('pagos'), 'titulo' => 'Pagos']
    ];
    $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

    return $data;
}



    private function create_view($vista, $data = [])
    {
        $data['menu_lateral'] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($vista, $data);
    }

    public function inicio()
    {
        $modelo = new Tabla_Pagos();
        $data = $this->load_data();
        $data['pagos'] = $modelo->getWithRelations(); // Método definido en el modelo
        return $this->create_view($this->view, $data);
    }

    public function agregar()
    {
        $data = $this->load_data();
        $data['usuarios'] = (new Tabla_usuario())->where('estatus_usuario', 1)->findAll();
        $data['planes'] = (new Tabla_Planes())->findAll();
        return $this->create_view('panel/pagos_nuevo', $data);
    }

    public function registrar()
    {
        $modelo = new Tabla_Pagos();

        $datos = [
            'fecha_registro_pago' => $this->request->getPost('fecha_registro_pago'),
            'estatus_pago' => 0, // por defecto pendiente
            'monto_pago' => $this->request->getPost('monto_pago'),
            'tarjeta_pago' => $this->request->getPost('tarjeta_pago'),
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_plan' => $this->request->getPost('id_plan')
        ];

        if ($modelo->insert($datos)) {
            make_message(SUCCESS_ALERT, 'Pago registrado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al registrar el pago.');
        }

        return redirect()->to(route_to('pagos'));
    }

    public function editar($id = 0)
    {
        $modelo = new Tabla_Pagos();
        $pago = $modelo->find($id);

        if (!$pago) {
            make_message(ERROR_ALERT, 'Pago no encontrado.');
            return redirect()->to(route_to('pagos'));
        }

        $data = $this->load_data();
        $data['pago'] = $pago;
        $data['usuarios'] = (new Tabla_usuario())->where('estatus_usuario', 1)->findAll();
        $data['planes'] = (new Tabla_Planes())->findAll();

        return $this->create_view('panel/pagos_editar', $data);
    }

    public function actualizar($id = 0)
    {
        $modelo = new Tabla_Pagos();
        $datos = [
            'fecha_registro_pago' => $this->request->getPost('fecha_registro_pago'),
            'monto_pago' => $this->request->getPost('monto_pago'),
            'tarjeta_pago' => $this->request->getPost('tarjeta_pago'),
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_plan' => $this->request->getPost('id_plan'),
            'estatus_pago' => $this->request->getPost('estatus_pago'),
        ];

        if ($modelo->update($id, $datos)) {
            make_message(SUCCESS_ALERT, 'Pago actualizado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar el pago.');
        }

        return redirect()->to(route_to('pagos'));
    }

    public function eliminar($id = 0)
    {
        $modelo = new Tabla_Pagos();
        if ($modelo->delete($id)) {
            make_message(SUCCESS_ALERT, 'Pago eliminado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al eliminar el pago.');
        }
        return redirect()->to(route_to('pagos'));
    }

    public function cambiar_estatus($id = 0)
{
    $modelo = new \App\Models\Tabla_Pagos();
    $pago = $modelo->find($id);

    if (!$pago) {
        make_message(ERROR_ALERT, 'Pago no encontrado.');
        return redirect()->to(route_to('pagos'));
    }


    switch ($pago->estatus_pago) {
        case 0:
            $nuevo_estatus = 1;
            break;
        case 1:
            $nuevo_estatus = -1;
            break;
        default:
            $nuevo_estatus = 0;
            break;
    }

    if ($modelo->update($id, ['estatus_pago' => $nuevo_estatus])) {
        make_message(SUCCESS_ALERT, 'Estatus del pago actualizado.');
    } else {
        make_message(ERROR_ALERT, 'No se pudo cambiar el estatus del pago.');
    }

    return redirect()->to(route_to('pagos'));
}

}
