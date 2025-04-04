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
        $data = [];
        $data['nombre_pagina'] = 'Blockbuster';
        $data['titulo_pagina'] = 'Géneros';
        $data['is_logged'] = $this->session->is_logged;

        $generosModel = new Tabla_Generos();
        $data['generos'] = array_filter($generosModel->get_all(), function ($genero) {
            return $genero->estatus_genero != -1;
        });

        return $data;
    }

    public function index()
    {
        return $this->make_view($this->view, $this->load_data());
    }

    public function ver($id_genero)
    {
        $generosModel = new Tabla_Generos();
        $streamingModel = new Tabla_Streaming();

        $genero = $generosModel->get_by_id($id_genero);
        if (!$genero || $genero->estatus_genero == -1) {
            return redirect()->to('/generos')->with('error', 'Género no encontrado o no disponible');
        }

        $contenidos = array_filter($streamingModel->where('id_genero', $id_genero)->findAll(), function ($contenido) {
            return $contenido->estatus_streaming != -1;
        });

        return $this->make_view($this->detalle_view, [
            'nombre_pagina' => 'Blockbuster - ' . $genero->nombre_genero,
            'titulo_pagina' => 'Streaming de ' . $genero->nombre_genero,
            'genero' => $genero,
            'contenidos' => $contenidos,
            'is_logged' => $this->session->is_logged,
        ]);
    }

    


    public function verStreaming($id_streaming)
    {
        $data = [];
    
        $streamingModel = new \App\Models\Tabla_Streaming();
        $generosModel = new \App\Models\Tabla_Generos();
        $usuarioPlanesModel = new \App\Models\Tabla_UsuariosPlanes();
        $alquilerModel = new \App\Models\Tabla_Alquileres();
        $tabla_pagos = new \App\Models\Tabla_Pagos();
    
        $contenido = $streamingModel->find($id_streaming);
        if (!$contenido || $contenido->estatus_streaming == -1) {
            return redirect()->to('/generos')->with('error', 'Contenido no disponible');
        }
    
        $data['is_logged'] = false;
        $data['puede_ver_streaming'] = false;
        $data['estatus_pago'] = null;
        $data['ya_alquilado'] = false;
        $data['bloqueado_por_plan'] = false;
    
        if ($this->session->get('is_logged')) {
            $id_usuario = $this->session->get('id_usuario');
            $data['is_logged'] = true;
    
            $hoy = date('Y-m-d');
            $plan = $usuarioPlanesModel->plan_usuario($id_usuario);
    
            if (!$plan || $plan->fecha_fin_plan < $hoy) {
                // Plan vencido: marcar todos los alquileres activos como finalizados
                $alquilerModel->where('id_usuario', $id_usuario)
                    ->where('estatus_alquiler', -1)
                    ->set(['estatus_alquiler' => 1])
                    ->update();
    
                // Marcar pago como consumido
                $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($id_usuario);
                if ($ultimo_pago) {
                    $tabla_pagos->update($ultimo_pago->id_pago, ['estatus_pago' => 2]);
                }
    
                $data['bloqueado_por_plan'] = true;
            } else {
                // Actualizar alquileres vencidos por fecha
                $alquilerModel->where('id_usuario', $id_usuario)
                    ->where('estatus_alquiler', -1)
                    ->where('fecha_fin_alquiler <=', $hoy)
                    ->set(['estatus_alquiler' => 1])
                    ->update();
    
                // Verificar alquiler activo
                $alquiler_activo = $alquilerModel
                    ->where('id_usuario', $id_usuario)
                    ->where('id_streaming', $id_streaming)
                    ->where('estatus_alquiler', -1)
                    ->first();
    
                if ($alquiler_activo) {
                    $data['puede_ver_streaming'] = true;
                    $data['ya_alquilado'] = true;
                } else {
                    $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($id_usuario);
                    if ($ultimo_pago && $ultimo_pago->estatus_pago == 1) {
                        $data['puede_ver_streaming'] = true;
                    }
                    $data['estatus_pago'] = $ultimo_pago ? $ultimo_pago->estatus_pago : null;
                }
            }
        }
    
        $genero = $generosModel->get_by_id($contenido->id_genero);
        $data['nombre_pagina'] = 'Blockbuster - ' . $contenido->nombre_streaming;
        $data['titulo_pagina'] = 'Detalle de ' . $contenido->nombre_streaming;
        $data['contenido'] = $contenido;
        $data['genero'] = $genero;
    
        return $this->make_view('portal/streaming_detalle', $data);
    }

    
    public function verAlquiler($archivo = null)
{
    $id_usuario = $this->session->get('id_usuario');
    $is_logged = $this->session->get('is_logged');

    if (!$is_logged || !$id_usuario) {
        make_message(WARNING_ALERT, 'Inicia sesión', 'Debes iniciar sesión para ver contenido');
        return redirect()->to(route_to('inicio'));
    }

    if (!$archivo || !is_file(FCPATH . RECURSOS_STREAM_VID . $archivo)) {
        make_message(ERROR_ALERT, 'Archivo no encontrado', 'El archivo del video no existe');
        return redirect()->to(route_to('generos'));
    }

    $streamingModel = new \App\Models\Tabla_Streaming();
    $alquilerModel = new \App\Models\Tabla_Alquileres();
    $usuarioPlanesModel = new \App\Models\Tabla_UsuariosPlanes();
    $tabla_pagos = new \App\Models\Tabla_Pagos();

    $contenido = $streamingModel->where('trailer_streaming', $archivo)->first();
    if (!$contenido) {
        make_message(ERROR_ALERT, 'Contenido no encontrado', 'No se encontró el contenido relacionado');
        return redirect()->to(route_to('generos'));
    }

    $hoy = date('Y-m-d');
    $plan = $usuarioPlanesModel->plan_usuario($id_usuario);

    if (!$plan || $plan->fecha_fin_plan < $hoy) {
        // Plan vencido: finalizar todos los alquileres
        $alquilerModel->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', -1)
            ->set(['estatus_alquiler' => 1])
            ->update();

        $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($id_usuario);
        if ($ultimo_pago) {
            $tabla_pagos->update($ultimo_pago->id_pago, ['estatus_pago' => 2]);
        }

        make_message(ERROR_ALERT, 'Plan vencido', 'Tu plan ha vencido. Contrata uno nuevo para continuar alquilando.');
        return redirect()->to(route_to('planes_disponibles'));
    }

    // Actualizar alquileres vencidos por fecha
    $alquilerModel->where('id_usuario', $id_usuario)
        ->where('estatus_alquiler', -1)
        ->where('fecha_fin_alquiler <', $hoy)
        ->set(['estatus_alquiler' => 1])
        ->update();

    // Verificar si ya tiene ese contenido alquilado
    $alquiler_existente = $alquilerModel
        ->where('id_usuario', $id_usuario)
        ->where('id_streaming', $contenido->id_streaming)
        ->where('estatus_alquiler', -1)
        ->first();

    if ($alquiler_existente) {
        return redirect()->to(base_url(RECURSOS_STREAM_VID . $archivo));
    }

    // Último pago aceptado
    $ultimo_pago = $tabla_pagos
        ->where('id_usuario', $id_usuario)
        ->where('estatus_pago', 1)
        ->orderBy('fecha_registro_pago', 'DESC')
        ->first();

    if (!$ultimo_pago) {
        make_message(ERROR_ALERT, 'Pago requerido', 'Debes tener un pago aprobado para alquilar contenido.');
        return redirect()->to(route_to('planes_disponibles'));
    }

    // Validar límite sin importar estatus
    $alquileresUsados = $alquilerModel
        ->where('id_usuario', $id_usuario)
        ->where('id_pago', $ultimo_pago->id_pago)
        ->countAllResults();

    if ($alquileresUsados >= $plan->cantidad_limite_plan) {
        $tabla_pagos->update($ultimo_pago->id_pago, ['estatus_pago' => 2]);
        make_message(INFO_ALERT, 'Límite alcanzado', 'Ya alcanzaste el límite de alquileres con tu plan actual.');
        return redirect()->to(route_to('perfil'));
    }

    // Registrar nuevo alquiler
    $fecha_inicio = date('Y-m-d');
    $fecha_fin = date('Y-m-d', strtotime("+5 days"));

    $alquilerModel->insert([
        'fecha_inicio_alquiler' => $fecha_inicio,
        'fecha_fin_alquiler' => $fecha_fin,
        'estatus_alquiler' => -1,
        'id_streaming' => $contenido->id_streaming,
        'id_usuario' => $id_usuario,
        'id_pago' => $ultimo_pago->id_pago
    ]);

    return redirect()->to(base_url(RECURSOS_STREAM_VID . $archivo));
}

        



private function make_view($name_view = '', $content = [])
{
    return view($name_view, $content);
}


}