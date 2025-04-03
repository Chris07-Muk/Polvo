<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Tabla_Videos;
use App\Models\Tabla_Streaming;

class Videos extends BaseController
{
    private $view = 'panel/videos';
    private $session = null;
    private $permiso = TRUE;
    private $carpetaVideos = 'videos/';

    public function __construct()
    {
        $this->session = session();

        helper("permisos_roles_helper");

        if (!acceso_usuario(TAREA_VIDEOS, $this->session->rol_actual)) {
            $this->permiso = FALSE;
        }

        $this->session->tarea_actual = TAREA_VIDEOS;
    }

    private function load_data()
    {
        helper('message');

        $data['nombre_pagnia'] = 'Videos';
        $data['titulo_pagina'] = 'Gestión de Videos';

        $data["nombre_completo_usuario"] = $this->session->nombre_completo;
        $data["nombre_usuario"] = $this->session->nickname;
        $data["email_usuario"] = $this->session->correo;
        $data["imagen_usuario"] = ($this->session->perfil == NULL)
            ? (($this->session->sexo == MASCULINO) ? 'HOMBRE.jpeg' : 'MUJER.jpeg')
            : $this->session->perfil;

        $breadcrumb = [
            ['href' => route_to("videos"), 'titulo' => 'Videos'],
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
        $data = $this->load_data();
        $modelo = new Tabla_Videos();
        $modeloStreaming = new Tabla_Streaming();

        // Obtener todos los títulos para el filtro (select)
        $data['streamings'] = $modeloStreaming->findAll();

        // Obtener parámetro GET para filtrar por título (streaming)
        $idStreaming = $this->request->getGet('id_streaming');

        // Si hay filtro, buscar solo los videos asociados
        if (!empty($idStreaming)) {
            $data['videos'] = $modelo->where('id_streaming', $idStreaming)->findAll();
            $data['filtro_streaming'] = $idStreaming;
        } else {
            $data['videos'] = $modelo->findAll();
            $data['filtro_streaming'] = '';
        }

        return $this->create_view($this->view, $data);
    } else {
        make_message(ERROR_ALERT, 'No tienes permisos para acceder a este módulo.', 'Error');
        return redirect()->to(route_to("inicio"));
    }
}


public function nuevo()
{
    $data = $this->load_data();
    $data['titulo_pagina'] = 'Nuevo Video';

    $modeloStreaming = new \App\Models\Tabla_Streaming();
    $data['streamings'] = $modeloStreaming->findAll();

    // Asegurar que la variable esté siempre definida para evitar errores
    $data['filtro_streaming'] = $this->request->getGet('id_streaming') ?? '';

    return $this->create_view('panel/videos_nuevo', $data);
}

    public function guardar()
    {
        helper('message');

        $modelo = new Tabla_Videos();

        $archivoVideo = $this->request->getFile('video');
        $nombreArchivo = $archivoVideo->isValid() ? $archivoVideo->getRandomName() : null;

        if ($nombreArchivo) {
            $archivoVideo->move($this->carpetaVideos, $nombreArchivo);
        }

        $data = [
            'estatus_video' => 1,
            'video' => $nombreArchivo,
            'nombre_temporada' => $this->request->getPost('nombre_temporada'),
            'video_temporada' => $this->request->getPost('video_temporada'),
            'capitulo_temporada' => $this->request->getPost('capitulo_temporada'),
            'descripcion_capitulo_temporada' => $this->request->getPost('descripcion_capitulo_temporada'),
            'id_streaming' => $this->request->getPost('id_streaming'),
        ];

        if ($modelo->insert($data)) {
            make_message(SUCCESS_ALERT, 'Registro exitoso.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Error al registrar el video.', 'Error');
        }

        return redirect()->to(route_to('videos'));
    }

    public function editar($id = 0)
    {
        $modelo = new Tabla_Videos();
        $modeloStreaming = new Tabla_Streaming();

        $data = $this->load_data();
        $data['video'] = $modelo->find($id);
        $data['streamings'] = $modeloStreaming->findAll();
        $data['titulo_pagina'] = 'Editar Video';

        if (!$data['video']) {
            make_message(ERROR_ALERT, 'No se encontró el registro.', 'Error');
            return redirect()->to(route_to('videos'));
        }

        return $this->create_view('panel/videos_editar', $data);
    }

    public function actualizar($id = 0)
    {
        helper('message');
    
        $modelo = new Tabla_Videos();
        $video = $modelo->find($id);
    
        if (!$video) {
            make_message(ERROR_ALERT, 'Video no encontrado.', 'Error');
            return redirect()->to(route_to('videos'));
        }
    
        $archivoVideo = $this->request->getFile('video');
        $nombreArchivo = $video->video; // ✅ Corrección aquí
    
        if ($archivoVideo->isValid() && !$archivoVideo->hasMoved()) {
            $nombreArchivo = $archivoVideo->getRandomName();
            $archivoVideo->move($this->carpetaVideos, $nombreArchivo);
        }
    
        $data = [
            'video' => $nombreArchivo,
            'nombre_temporada' => $this->request->getPost('nombre_temporada'),
            'video_temporada' => $this->request->getPost('video_temporada'),
            'capitulo_temporada' => $this->request->getPost('capitulo_temporada'),
            'descripcion_capitulo_temporada' => $this->request->getPost('descripcion_capitulo_temporada'),
            'id_streaming' => $this->request->getPost('id_streaming'),
        ];
    
        if ($modelo->update($id, $data)) {
            make_message(SUCCESS_ALERT, 'Actualización exitosa.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Error al actualizar el video.', 'Error');
        }
    
        return redirect()->to(route_to('videos'));
    }
    

    public function eliminar($id = 0)
    {
        helper('message');

        $modelo = new Tabla_Videos();
        if ($modelo->find($id)) {
            $modelo->delete($id);
            make_message(SUCCESS_ALERT, 'Eliminado correctamente.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'Registro no encontrado.', 'Error');
        }

        return redirect()->to(route_to('videos'));
    }

    public function estatus($id = 0, $estatus = 1)
    {
        helper('message');

        $modelo = new Tabla_Videos();
        if ($modelo->find($id)) {
            $modelo->update($id, ['estatus_video' => $estatus]);
            make_message(SUCCESS_ALERT, 'Estatus actualizado.', 'Éxito!');
        } else {
            make_message(ERROR_ALERT, 'No se encontró el video.', 'Error');
        }

        return redirect()->to(route_to('videos'));
    }
}
