<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Alquileres;
use App\Models\Tabla_usuario;
use App\Models\Tabla_Streaming;

class Alquileres extends BaseController
{
    private $view = 'panel/alquileres';
    private $session = null;

    public function __construct()
    {
        $this->session = session();

    // Helpers necesarios
    helper(['form', 'message', 'permisos_roles_helper']);

    // Asignar la tarea actual para activar el menú lateral
    $this->session->tarea_actual = TAREA_ALQUILERES;
    }
    private function load_data()
    {
        $data = [
            'titulo_pagina' => 'Alquileres',
            'nombre_pagnia' => 'Gestión de Alquileres',
            'nombre_completo_usuario' => $this->session->nombre_completo ?? '',
            'nombre_usuario' => $this->session->nickname ?? '',
            'email_usuario' => $this->session->correo ?? '',
            'imagen_usuario' => $this->session->perfil ?? (($this->session->sexo ?? '') == MASCULINO ? 'HOMBRE.jpeg' : 'MUJER.jpeg'),
        ];
    
        // Breadcrumb si lo usas en la plantilla base
        $breadcrumb = [
            ['href' => route_to('alquileres'), 'titulo' => 'Alquileres']
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);
    
        return $data;
    }
    

    private function create_view($vista, $data = [])
    {
        $data['menu_lateral'] = crear_menu_panel($this->session->tarea_actual ?? '', $this->session->rol_actual ?? '');
        return view($vista, $data);
    }

    public function inicio()
{
    $modelo = new Tabla_Alquileres();

    $data = $this->load_data();

    $data['alquileres'] = $modelo
        ->select('alquileres.*, usuarios.nombre_usuario, usuarios.ap_usuario, streaming.nombre_streaming')
        ->join('usuarios', 'usuarios.id_usuario = alquileres.id_usuario')
        ->join('streaming', 'streaming.id_streaming = alquileres.id_streaming')
        ->findAll();

    // Retornamos la vista principal con los datos
    return $this->create_view($this->view, $data);
}


    public function agregar()
    {
        $data = $this->load_data();
        $data['usuarios'] = (new Tabla_usuario())->findAll();
        $data['streamings'] = (new Tabla_Streaming())->findAll();
        return $this->create_view('panel/alquileres_nuevo', $data);
    }

    public function registrar()
    {
        $modelo = new Tabla_Alquileres();

        $datos = [
            'fecha_inicio_alquiler' => $this->request->getPost('fecha_inicio_alquiler'),
            'fecha_fin_alquiler' => $this->request->getPost('fecha_fin_alquiler'),
            'estatus_alquiler' => -1, // En proceso por defecto
            'id_streaming' => $this->request->getPost('id_streaming'),
            'id_usuario' => $this->request->getPost('id_usuario')
        ];

        if ($modelo->insert($datos)) {
            make_message(SUCCESS_ALERT, 'Alquiler registrado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al registrar el alquiler.');
        }

        return redirect()->to(route_to('alquileres'));
    }

    public function editar($id)
    {
        $modelo = new Tabla_Alquileres();
        $alquiler = $modelo->find($id);

        if (!$alquiler) {
            make_message(ERROR_ALERT, 'Alquiler no encontrado.');
            return redirect()->to(route_to('alquileres'));
        }

        $data = $this->load_data();
        $data['alquiler'] = $alquiler;
        $data['usuarios'] = (new Tabla_usuario())->findAll();
        $data['streaming'] = (new Tabla_Streaming())->findAll(); 


        return $this->create_view('panel/alquileres_editar', $data);
    }

    public function actualizar($id)
    {
        $modelo = new Tabla_Alquileres();

        $datos = [
            'fecha_inicio_alquiler' => $this->request->getPost('fecha_inicio_alquiler'),
            'fecha_fin_alquiler' => $this->request->getPost('fecha_fin_alquiler'),
            'estatus_alquiler' => $this->request->getPost('estatus_alquiler'),
            'id_streaming' => $this->request->getPost('id_streaming'),
            'id_usuario' => $this->request->getPost('id_usuario')
        ];

        if ($modelo->update($id, $datos)) {
            make_message(SUCCESS_ALERT, 'Alquiler actualizado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar el alquiler.');
        }

        return redirect()->to(route_to('alquileres'));
    }

    public function eliminar($id)
    {
        $modelo = new Tabla_Alquileres();

        if ($modelo->delete($id)) {
            make_message(SUCCESS_ALERT, 'Alquiler eliminado correctamente.');
        } else {
            make_message(ERROR_ALERT, 'Error al eliminar el alquiler.');
        }

        return redirect()->to(route_to('alquileres'));
    }

    public function cambiar_estatus($id)
    {
        $modelo = new Tabla_Alquileres();
        $registro = $modelo->find($id);

        if (!$registro) {
            make_message(ERROR_ALERT, 'Alquiler no encontrado.');
            return redirect()->to(route_to('alquileres'));
        }

        $nuevo = $registro->estatus_alquiler == 1 ? -1 : 1;
        $modelo->update($id, ['estatus_alquiler' => $nuevo]);

        make_message(SUCCESS_ALERT, 'Estatus actualizado correctamente.');
        return redirect()->to(route_to('alquileres'));
    }
}
