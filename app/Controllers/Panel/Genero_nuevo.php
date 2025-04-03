<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Generos;

class Genero_nuevo extends BaseController
{
    private $view = 'panel/genero_nuevo';
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
        $data = [];

        $data['nombre_pagnia'] = 'Géneros';
        $data['titulo_pagina'] = 'Registrar nuevo género';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        $data["imagen_usuario"] = ($this->session->perfil == NULL)
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')
            : $this->session->perfil;

        $breadcrumb = [
            ['href' => route_to("generos"), 'titulo' => 'Géneros'],
            ['href' => '#', 'titulo' => 'Nuevo Género']
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        return $data;
    }

    private function create_view($name_view = '', $content = [])
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
            return redirect()->to(route_to("inicio"));
        }
    }

    public function registrar()
    {
        helper('message');

        $genero = [
            "estatus_genero" => 1,
            "nombre_genero" => $this->request->getPost("nombre_genero"),
            "descripcion_genero" => $this->request->getPost("descripcion_genero")
        ];
        

        $tabla_generos = new Tabla_Generos();

        if ($tabla_generos->create($genero)) {
            make_message(SUCCESS_ALERT, 'Se ha registrado el género correctamente.', 'Éxito');
            return redirect()->to(route_to("generos"));
        } else {
            make_message(ERROR_ALERT, 'Error al registrar el género.', 'Error');
            return redirect()->to(route_to("nuevo_genero"));
        }
    }
}
