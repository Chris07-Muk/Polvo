<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class Genero_detalles extends BaseController
{
    private $view = 'panel/genero_detalles';
    private $session = null;
    private $permiso = TRUE;

    public function __construct(){
        $this->session = session();
        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_GENEROS, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }

        $this->session->tarea_actual = TAREA_GENEROS;
    }

    private function load_data($id_genero = 0){
        helper('message');
        $data = [];

        $data['nombre_pagnia'] = 'Género Detalles';
        $data['titulo_pagina'] = 'Editar Género';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        $data["imagen_usuario"] = ($this->session->perfil == NULL) 
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg') 
            : $this->session->perfil;

        $breadcrumb = [
            ['href' => route_to("generos"), 'titulo' => 'Géneros'],
            ['href' => '#', 'titulo' => 'Editar Género']
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        $tabla_generos = new \App\Models\Tabla_Generos;
        $data['genero'] = $tabla_generos->get_by_id($id_genero);

        return $data;
    }

    private function create_view($name_view = '', $content = []){
        $content["menu_lateral"] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($name_view, $content);
    }

    public function index($id_genero = 0){
        helper('message');
        if ($this->permiso) {
            $tabla_generos = new \App\Models\Tabla_Generos;
            if ($tabla_generos->find($id_genero) == null) {
                make_message(ERROR_ALERT, 'El género que solicitas no se ha encontrado.', 'Error');
                return redirect()->to(route_to("generos"));
            } else {
                return $this->create_view($this->view, $this->load_data($id_genero));
            }
        } else {
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
            return redirect()->to(route_to("inicio"));
        }
    }

    public function actualizar($id_genero = 0)
{
    helper('message');

    $tabla_generos = new \App\Models\Tabla_Generos;

    if ($tabla_generos->find($id_genero)) {
        $genero = [
            "nombre_genero" => $this->request->getPost("nombre"),
            "descripcion_genero" => $this->request->getPost("descripcion"),
            "estatus_genero" => $this->request->getPost("estatus") // ← Aquí se permite 1 o -1
        ];

        if ($tabla_generos->update_data($id_genero, $genero)) {
            make_message(SUCCESS_ALERT, 'Género actualizado correctamente.', 'Éxito!');
            return redirect()->to(route_to("generos"));
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar el género.', 'Error');
            return $this->index($id_genero);
        }
    } else {
        make_message(ERROR_ALERT, 'El género que solicitas actualizar no se ha encontrado.', 'Error');
        return redirect()->to(route_to("generos"));
    }
}

}
