<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class Generos extends BaseController
{
    private $view = 'panel/generos';
    private $session = null;
    private $permiso = TRUE;

    public function __construct()
    {
        $this->session = session();

        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_GENEROS, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }

        $this->session->tarea_actual = TAREA_GENEROS;
    }

    private function load_data()
    {
        helper('message');

        $data = array();
        $data['nombre_pagnia'] = 'Géneros';
        $data['titulo_pagina'] = 'Gestión de Géneros';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        $data["imagen_usuario"] = ($this->session->perfil == NULL)
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')
            : $this->session->perfil;

        $breadcrumb = array(
            array(
                'href' => route_to("generos"),
                'titulo' => 'Géneros',
            ),
            array(
                'href' => '#',
                'titulo' => 'Gestión de Géneros',
            )
        );
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        // Aquí puedes llamar al modelo para obtener los géneros si ya lo tienes
        $tabla_generos = new \App\Models\Tabla_Generos();
        $data["generos"] = $tabla_generos->findAll();

        return $data;
    }

    private function create_view($name_view = '', $content = array())
    {
        $content["menu_lateral"] = crear_menu_panel($this->session->tarea_actual, $this->session->rol_actual);
        return view($name_view, $content);
    }

    public function index()
    {
        if ($this->permiso) {
            return $this->create_view($this->view, $this->load_data());
        } else {
            helper('message');
            make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
            return redirect()->to(route_to("generos"));
        }
    }

    public function eliminar($id = 0)
{
    helper('message');

    $tabla_generos = new \App\Models\Tabla_Generos();

    // Verifica si existe
    $genero = $tabla_generos->find($id);

    if ($genero) {
        if ($tabla_generos->delete_data($id)) {
            make_message(SUCCESS_ALERT, 'El género ha sido eliminado correctamente.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'No se pudo eliminar el género.', 'Error!');
        }
    } else {
        make_message(ERROR_ALERT, 'El género no existe.', 'Error!');
    }

    return redirect()->to(route_to('generos'));
}

public function estatus($id_genero = 0, $estatus = FALSE) {
    helper('message');

    $tabla_generos = new \App\Models\Tabla_Generos;
    if ($tabla_generos->find($id_genero)) {
        if ($tabla_generos->update_data($id_genero, ["estatus_genero" => $estatus])) {
            make_message(SUCCESS_ALERT, 'Se actualizó el estatus del género.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar el estatus.', 'Error');
        }
    } else {
        make_message(ERROR_ALERT, 'Género no encontrado.', 'Error');
    }

    return redirect()->to(route_to('generos'));
}



}
