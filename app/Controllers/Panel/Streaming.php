<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Streaming;
use App\Models\Tabla_Generos;

class Streaming extends BaseController
{
    private $view = 'panel/streaming';
    private $session = null;
    private $permiso = TRUE;
    private $carpetaCaratulas = 'streaming/caratulas/';
    private $carpetaTrailers = 'streaming/trailers/';

    public function __construct()
    {
        $this->session = session();

        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_STREAMING, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }

        $this->session->tarea_actual = TAREA_STREAMING;
    }

    private function load_data()
    {
        helper('message');

        $data['nombre_pagnia'] = 'Streaming';
        $data['titulo_pagina'] = 'Catálogo de Streaming';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        $data['imagen_usuario'] = ($this->session->perfil == NULL)
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')
            : $this->session->perfil;

        $breadcrumb = [
            ['href' => route_to("streaming"), 'titulo' => 'Streaming'],
        ];
        $data['breadcrumb_panel'] = breadcrumb_panel($data['titulo_pagina'], $breadcrumb);

        $tabla = new Tabla_Streaming();
        $data['streamings'] = $tabla->findAll();

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

    public function nuevo()
    {
        $data = $this->load_data();
        $data['titulo_pagina'] = 'Nuevo Streaming';
        $modeloGenero = new Tabla_Generos();
        $data['generos'] = $modeloGenero->findAll();

        return $this->create_view('panel/streaming_nuevo', $data);
    }

    public function guardar()
    {
        helper('message');
        $modelo = new Tabla_Streaming();

        $caratula = $this->request->getFile('caratula_streaming');
        $trailer = $this->request->getFile('trailer_streaming');

        $nombreCaratula = $caratula->isValid() ? $caratula->getRandomName() : null;
        $nombreTrailer = $trailer->isValid() ? $trailer->getRandomName() : null;

        if ($nombreCaratula) $caratula->move($this->carpetaCaratulas, $nombreCaratula);
        if ($nombreTrailer) $trailer->move($this->carpetaTrailers, $nombreTrailer);

        $data = [
            'estatus_streaming' => 1,
            'nombre_streaming' => $this->request->getPost('nombre'),
            'fecha_lanzamiento_streaming' => $this->request->getPost('fecha_lanzamiento'),
            'duracion_streaming' => $this->request->getPost('duracion'),
            'temporadas_streaming' => $this->request->getPost('temporadas'),
            'caratula_streaming' => $nombreCaratula,
            'trailer_streaming' => $nombreTrailer,
            'clasificacion_streaming' => $this->request->getPost('clasificacion'),
            'sipnosis_streaming' => $this->request->getPost('sipnosis'),
            'fecha_estreno_streaming' => $this->request->getPost('fecha_estreno'),
            'id_genero' => $this->request->getPost('id_genero')
        ];

        if ($modelo->insert($data)) {
            make_message(SUCCESS_ALERT, 'Registro exitoso.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Error al registrar.', 'Error');
        }

        return redirect()->to(route_to('streaming'));
    }

    public function editar($id = 0)
{
    $modelo = new Tabla_Streaming();
    $modeloGenero = new Tabla_Generos();

    $data = $this->load_data(); // Asegura que las variables de sesión estén disponibles

    $data['streaming'] = $modelo->find($id);
    $data['generos'] = $modeloGenero->findAll();
    $data['titulo_pagina'] = 'Editar Streaming';

    if (!$data['streaming']) {
        make_message(ERROR_ALERT, 'No se encontró el registro.', 'Error');
        return redirect()->to(route_to('streaming'));
    }

    return $this->create_view('panel/streaming_editar', $data);
}

public function actualizar($id = 0)
{
    helper('message');

    $modelo = new Tabla_Streaming();
    $streaming = $modelo->find($id); // Retorna un objeto (returnType = 'object')

    if (!$streaming) {
        make_message(ERROR_ALERT, 'Streaming no encontrado.', 'Error');
        return redirect()->to(route_to('streaming'));
    }

    $caratula = $this->request->getFile('caratula_streaming');
    $trailer = $this->request->getFile('trailer_streaming');

    // Corrección: uso de -> en lugar de []
    $nombreCaratula = $streaming->caratula_streaming;
    $nombreTrailer = $streaming->trailer_streaming;

    if ($caratula->isValid() && !$caratula->hasMoved()) {
        $nombreCaratula = $caratula->getRandomName();
        $caratula->move($this->carpetaCaratulas, $nombreCaratula);
    }

    if ($trailer->isValid() && !$trailer->hasMoved()) {
        $nombreTrailer = $trailer->getRandomName();
        $trailer->move($this->carpetaTrailers, $nombreTrailer);
    }

    $data = [
        'nombre_streaming' => $this->request->getPost('nombre'),
        'fecha_lanzamiento_streaming' => $this->request->getPost('fecha_lanzamiento'),
        'duracion_streaming' => $this->request->getPost('duracion'),
        'temporadas_streaming' => $this->request->getPost('temporadas'),
        'caratula_streaming' => $nombreCaratula,
        'trailer_streaming' => $nombreTrailer,
        'clasificacion_streaming' => $this->request->getPost('clasificacion'),
        'sipnosis_streaming' => $this->request->getPost('sipnosis'),
        'fecha_estreno_streaming' => $this->request->getPost('fecha_estreno'),
        'id_genero' => $this->request->getPost('id_genero')
    ];

    if ($modelo->update($id, $data)) {
        make_message(SUCCESS_ALERT, 'Actualización exitosa.', 'Éxito!');
    } else {
        make_message(ERROR_ALERT, 'Error al actualizar.', 'Error');
    }

    return redirect()->to(route_to('streaming'));
}


    public function eliminar($id = 0)
    {
        helper('message');

        $modelo = new Tabla_Streaming();
        if ($modelo->find($id)) {
            $modelo->delete($id);
            make_message(SUCCESS_ALERT, 'Eliminado correctamente.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Registro no encontrado.', 'Error');
        }

        return redirect()->to(route_to('streaming'));
    }

    public function estatus($id = 0, $estatus = 1)
    {
        helper('message');

        $modelo = new Tabla_Streaming();
        if ($modelo->find($id)) {
            $modelo->update($id, ['estatus_streaming' => $estatus]);
            make_message(SUCCESS_ALERT, 'Estatus actualizado.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'No se encontró el streaming.', 'Error');
        }

        return redirect()->to(route_to('streaming'));
    }
}