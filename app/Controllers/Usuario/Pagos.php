<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use App\Models\Tabla_Pagos;
use App\Models\Tabla_UsuariosPlanes;

class Pagos extends BaseController
{
    private $view = 'usuario/pagos';
    private $session = null;

    public function __construct()
    {
        $this->session = session();
        helper('message');
    }

    private function load_data()
    {
        $data = [];

        $data['nombre_pagina'] = 'Pagos';
        $data['titulo_pagina'] = 'Gestión de pagos';

        $data["is_logged"] = $this->session->get('is_logged');
        $data["id_usuario"] = $this->session->get('id_usuario');
        $data["nombre_completo_usuario"] = $this->session->get('nombre_completo');
        $data["nombre_usuario"] = $this->session->get('nickname');
        $data["email_usuario"] = $this->session->get('correo');
        $data["nombre_plan"] = $this->session->get('nombre_plan');
        $data["precio_plan"] = $this->session->get('precio_plan');

        // Cargar estado del último pago (si existe)
        $tabla_pagos = new Tabla_Pagos();
        $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($this->session->get('id_usuario'));

        $data['estatus_pago'] = $ultimo_pago ? $ultimo_pago->estatus_pago : null;

        return $data;
    }

    private function create_view($name_view = '', $content = [])
    {
        return view($name_view, $content);
    }

    // Página principal de pagos
    public function index()
{
    if (!$this->session->get('is_logged')) {
        make_message(WARNING_ALERT, "Se necesita acceso", "Se necesita iniciar sesión para acceder a este módulo");
        return redirect()->to(route_to("portal"));
    }

    if (!$this->session->get('id_plan')) {
        make_message(INFO_ALERT, "Adquiere un plan", "No hay pagos por procesar");
        return redirect()->to(route_to("perfil"));
    }

    // Consultar último pago directamente desde la base
    $tabla_pagos = new Tabla_Pagos();
    $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($this->session->get('id_usuario'));

    if ($ultimo_pago) {
        if ($ultimo_pago->estatus_pago == 1) {
            // Pago aceptado
            make_message(SUCCESS_ALERT, "¡Pago aceptado!", "Tu último pago fue aprobado exitosamente.");
            return redirect()->to(route_to("perfil"));
        } elseif ($ultimo_pago->estatus_pago == 0) {
            // Pago pendiente
            make_message(INFO_ALERT, "Pago en proceso", "Tienes un pago pendiente en revisión.");
            return redirect()->to(route_to("perfil"));
        }
        // Si es -1 (rechazado), continúa para permitir nuevo intento
    }

    // Refrescar datos del plan
    $tabla_usuario_planes = new \App\Models\Tabla_UsuariosPlanes();
    $plan = $tabla_usuario_planes->plan_usuario($this->session->get('id_usuario'));

    if ($plan) {
        $this->session->set('plan', true);
        $this->session->set('nombre_plan', $plan->nombre_plan);
        $this->session->set('dias_activo', $plan->dias_activo);
        $this->session->set('precio_plan', $plan->precio_plan);
        $this->session->set('id_plan', $plan->id_plan);
    } else {
        $this->session->set('plan', false);
    }

    return $this->create_view($this->view, $this->load_data());
}


    // Procesar pago
    public function validar_pago()
    {
        $tabla_pagos = new Tabla_Pagos();

        $pago = [
            "fecha_registro_pago" => date('Y-m-d'),
            "estatus_pago" => ESTATUS_DESHABILITADO, // o usa 0 directamente
            "monto_pago" => $this->session->get('precio_plan'),
            "tarjeta_pago" => $this->request->getPost("num_tarjeta"),
            "id_usuario" => $this->session->get('id_usuario'),
            "id_plan" => $this->session->get('id_plan')
        ];

        if ($tabla_pagos->insert($pago) > 0) {
            make_message(SUCCESS_ALERT, "Pago registrado", "Tu pago ha sido enviado para validación.");
            return redirect()->to(route_to("pagos_portal"));
        } else {
            make_message(ERROR_ALERT, "Error", "No se pudo registrar el pago.");
            return redirect()->back();
        }
    }
}
