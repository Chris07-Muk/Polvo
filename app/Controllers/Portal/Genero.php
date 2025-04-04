<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use App\Models\Tabla_Generos;
use App\Models\Tabla_Streaming;
use App\Models\Tabla_Alquileres;
use App\Models\Tabla_UsuariosPlanes;

class Genero extends BaseController
{
    private $view = 'portal/genero';
    private $detalle_view = 'portal/genero_detalle';
    private $session;

    public function __construct()
    {
        $this->session = session();
        helper("message");
    }

    private function load_data()
    {
        // Datos basicos de la página
        $data = [];
        $data['nombre_pagina'] = 'Blockbuster';
        $data['titulo_pagina'] = 'Géneros';
        // Estado de la sesion
        $data['is_logged'] = $this->session->is_logged;

        // Instanciamos el modelo
        $generosModel = new Tabla_Generos();
        // Obtenemos todos los generos y los filtramos en base a estatus 1 (activo) -1 (inactivo)
        $data['generos'] = array_filter($generosModel->get_all(), function ($genero) {
            return $genero->estatus_genero != -1;
        });

        // Retornamos $data
        return $data;
    }

    public function index()
    {
        return $this->make_view($this->view, $this->load_data());
    }

    public function ver($id_genero)
    {
        // Instanciamos los modelos
        $generosModel = new Tabla_Generos();
        $streamingModel = new Tabla_Streaming();

        $genero = $generosModel->get_by_id($id_genero);

        // Verificamos la existencia y estatus del genero
        if (!$genero || $genero->estatus_genero == -1) {
            return redirect()->to('/generos')->with('error', 'Género no encontrado o no disponible');
        }

        $contenidos = array_filter($streamingModel->where('id_genero', $id_genero)->findAll(), function ($contenido) {
            // Filtramos contenidos eliminados (estatus -1)
            return $contenido->estatus_streaming != -1;
        });

        return $this->make_view($this->detalle_view, [
            // Datos de la página
            'nombre_pagina' => 'Blockbuster - ' . $genero->nombre_genero,
            'titulo_pagina' => 'Streaming de ' . $genero->nombre_genero,
            //Datos principales
            'genero' => $genero,
            'contenidos' => $contenidos,
            // Estado de la sesion
            'is_logged' => $this->session->is_logged,
        ]);
    }



    public function verStreaming($id_streaming)
    {

        // VALIDACIÓN DEL CONTENIDO STREAMING

        $contenido = (new \App\Models\Tabla_Streaming())->find($id_streaming);

        // Verificar existencia y estatus del contenido
        if (!$contenido || $contenido->estatus_streaming == -1) {
            return redirect()->to('/generos')->with('error', 'Contenido no disponible');
        }

        // INICIALIZACIÓN DE DATOS PARA LA VISTA

        $data = [
            'is_logged' => false,
            'puede_ver_streaming' => false,
            'estatus_pago' => null,
            'ya_alquilado' => false,
            'nombre_pagina' => 'Blockbuster - ' . $contenido->nombre_streaming,
            'titulo_pagina' => 'Detalle de ' . $contenido->nombre_streaming,
            'contenido' => $contenido,
            'genero' => (new \App\Models\Tabla_Generos())->get_by_id($contenido->id_genero)
        ];

        // VERIFICACIÓN DE PERMISOS PARA USUARIOS LOGUEADOS
        if ($this->session->get('is_logged')) {
            $id_usuario = $this->session->get('id_usuario');
            $data['is_logged'] = true;
            $hoy = date('Y-m-d');

            // Actualizar alquileres vencidos
            $this->actualizarAlquileresVencidos($id_usuario, $hoy);

            // Verificar acceso al contenido
            $data = array_merge($data, $this->verificarAccesoContenido($id_usuario, $id_streaming));
        }

        return $this->make_view('portal/streaming_detalle', $data);
    }


    //  Actualiza alquileres vencidos a estado "finalizado" (1)

    private function actualizarAlquileresVencidos($id_usuario, $hoy)
    {
        (new \App\Models\Tabla_Alquileres())
            ->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', -1)
            ->where('fecha_fin_alquiler <=', $hoy)
            ->set(['estatus_alquiler' => 1])
            ->update();
    }

    // Verifica los permisos de acceso al contenido

    private function verificarAccesoContenido($id_usuario, $id_streaming)
    {
        $resultado = [
            'puede_ver_streaming' => false,
            'ya_alquilado' => false,
            'estatus_pago' => null
        ];

        // Verificar alquiler activo
        $alquilerModel = new \App\Models\Tabla_Alquileres();
        $alquiler_activo = $alquilerModel
            ->where('id_usuario', $id_usuario)
            ->where('id_streaming', $id_streaming)
            ->where('estatus_alquiler', -1)
            ->first();

        if ($alquiler_activo) {
            $resultado['puede_ver_streaming'] = true;
            $resultado['ya_alquilado'] = true;
        } else {
            // Verificar pago activo
            $ultimo_pago = (new \App\Models\Tabla_Pagos())->ultimo_pago_usuario($id_usuario);
            $resultado['puede_ver_streaming'] = ($ultimo_pago && $ultimo_pago->estatus_pago == 1);
            $resultado['estatus_pago'] = $ultimo_pago ? $ultimo_pago->estatus_pago : null;
        }

        return $resultado;
    }






    public function verAlquiler($archivo = null)
    {
        // Instanciamos los modelos
        $streamingModel = new \App\Models\Tabla_Streaming();
        $alquilerModel = new \App\Models\Tabla_Alquileres();
        $usuarioPlanesModel = new \App\Models\Tabla_UsuariosPlanes();
        $tabla_pagos = new \App\Models\Tabla_Pagos();

        //Obtenemos el id de usuario y el estado de la sesion
        $id_usuario = $this->session->get('id_usuario');
        $is_logged = $this->session->get('is_logged');

        // Obtenemos la fecha del sistema
        $hoy = date('Y-m-d');

        // Si la sesion es inactiva redireccionamos al inicio
        if (!$is_logged || !$id_usuario) {
            make_message(WARNING_ALERT, 'Inicia sesión', 'Debes iniciar sesión para ver contenido');
            return redirect()->to(route_to('inicio'));
        }

        // Verificamos que el archivo existe
        if (!$archivo || !is_file(FCPATH . RECURSOS_STREAM_VID . $archivo)) {
            make_message(ERROR_ALERT, 'Archivo no encontrado', 'El archivo del video no existe');
            return redirect()->to(route_to('generos'));
        }

        // Obtenemos el contenido y verificamos que exista
        $contenido = $streamingModel->where('trailer_streaming', $archivo)->first();
        if (!$contenido) {
            make_message(ERROR_ALERT, 'Contenido no encontrado', 'No se encontró el contenido relacionado');
            return redirect()->to(route_to('generos'));
        }

        $plan = $usuarioPlanesModel->plan_usuario($id_usuario);
        if (!$plan) {
            make_message(ERROR_ALERT, 'Sin plan', 'Debes contratar un plan para ver contenido');
            return redirect()->to(route_to('planes_disponibles'));
        }


        // Actualizar alquileres vencidos
        $alquilerModel->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', -1)
            ->where('fecha_fin_alquiler <', $hoy)
            ->set(['estatus_alquiler' => 1])
            ->update();

        // Verificar si ya existe alquiler activo
        $alquiler_existente = $alquilerModel
            ->where('id_usuario', $id_usuario)
            ->where('id_streaming', $contenido->id_streaming)
            ->where('estatus_alquiler', -1)
            ->first();

        if ($alquiler_existente) {
            return redirect()->to(base_url(RECURSOS_STREAM_VID . $archivo));
        }

        // Obtener último pago aceptado
        $ultimo_pago = $tabla_pagos
            ->where('id_usuario', $id_usuario)
            ->where('estatus_pago', 1)
            ->orderBy('fecha_registro_pago', 'DESC')
            ->first();

        // Si no hay pago válido, no continúa
        if (!$ultimo_pago) {
            make_message(ERROR_ALERT, 'Pago requerido', 'Debes tener un pago aprobado para alquilar contenido.');
            return redirect()->to(route_to('planes_disponibles'));
        }

        // Verificar cuántos alquileres activos tiene con ese pago
        $alquileresActivos = $alquilerModel
            ->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', -1)
            ->where('id_pago', $ultimo_pago->id_pago)
            ->countAllResults();

        if ($alquileresActivos >= $plan->cantidad_limite_plan) {
            // Marcar como consumido
            $tabla_pagos->update($ultimo_pago->id_pago, ['estatus_pago' => 2]);

            make_message(INFO_ALERT, 'Límite alcanzado', 'Ya alcanzaste el límite de alquileres con tu plan actual.');
            return redirect()->to(route_to('perfil'));
        }

        // Registrar alquiler
        $fecha_inicio = date('Y-m-d');
        $fecha_fin = date('Y-m-d', strtotime("+5 days"));

        $alquilerModel->insert([
            'fecha_inicio_alquiler' => $fecha_inicio,
            'fecha_fin_alquiler' => $fecha_fin,
            'estatus_alquiler' => -1,
            'id_streaming' => $contenido->id_streaming,
            'id_usuario' => $id_usuario,
            'id_pago' => $ultimo_pago->id_pago // Asociamos correctamente el pago
        ]);

        return redirect()->to(base_url(RECURSOS_STREAM_VID . $archivo));
    }



    private function make_view($name_view = '', $content = [])
    {
        return view($name_view, $content);
    }
}
