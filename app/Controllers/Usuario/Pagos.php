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

        // Datos de usuario para la sesión 
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

    // Funcion/Metodo principal controller pagos
    public function index()
    {
        // Validación de sesión
        if (!session('is_logged')) {
            make_message(WARNING_ALERT, "Se necesita acceso", "Se necesita iniciar sesión para acceder a este módulo");
            return redirect()->to(route_to("portal"));
        }

        $id_usuario = session('id_usuario');
        $hoy = date('Y-m-d');

        // Verificacion del plan activo desde base de datos
        $tabla_usuario_planes = new \App\Models\Tabla_UsuariosPlanes();
        $plan = $tabla_usuario_planes->plan_usuario($id_usuario);

        if (!$plan || $plan->fecha_fin_plan < $hoy) {
            make_message(ERROR_ALERT, "Plan requerido", "Tu plan ha vencido. Contrata uno nuevo antes de pagar.");
            return redirect()->to(route_to("planes_disponibles"));
        }

        // Verifica si hay pagos existentes
        
        // Instanciamos el modelo
        $tabla_pagos = new Tabla_Pagos();
        $ultimo_pago = $tabla_pagos->ultimo_pago_usuario($this->session->get('id_usuario'));

        if ($ultimo_pago) {
            if ($ultimo_pago->estatus_pago == 1) {
                make_message(SUCCESS_ALERT, "¡Pago aceptado!", "Tu último pago fue aprobado exitosamente.");
                return redirect()->to(route_to("perfil"));
            } elseif ($ultimo_pago->estatus_pago == 0) {
                make_message(INFO_ALERT, "Pago en proceso", "Tienes un pago pendiente en revisión.");
                return redirect()->to(route_to("perfil"));
            }
        }

        // Actualizar los datos de la variable de sesion
        $this->session->set('plan', true);
        $this->session->set('nombre_plan', $plan->nombre_plan);
        $this->session->set('dias_activo', $plan->dias_activo);
        $this->session->set('precio_plan', $plan->precio_plan);
        $this->session->set('id_plan', $plan->id_plan);

        return $this->create_view($this->view, $this->load_data());
    }

    // Procesar pago
    public function validar_pago()
    {
        // Obtenemos ID de usuario de la sesión
        $id_usuario = $this->session->get('id_usuario'); 
        // Instanciamos el modelo
        $tabla_pagos = new Tabla_Pagos();
        $tabla_usuario_planes = new \App\Models\Tabla_UsuariosPlanes();

        // Consultamos el plan activo con el que cuenta el usuario
        $plan = $tabla_usuario_planes->plan_usuario($id_usuario);

        $hoy = date('Y-m-d');

        // Verificamos si el usuario tiene plan activo y no está vencido
        if (!$plan || $plan->fecha_fin_plan < $hoy) {
            make_message(ERROR_ALERT, "Error", "No tienes un plan activo. Contrata uno antes de pagar.");
            return redirect()->to(route_to("planes_disponibles"));
        }

        $pago = [
            "fecha_registro_pago" => date('Y-m-d'),// Fecha actual del sistema
            "estatus_pago" => ESTATUS_DESHABILITADO, // Estado inicial (pendiente)
            "monto_pago" => $this->session->get('precio_plan'), // Precio del plan desde sesión
            "tarjeta_pago" => $this->request->getPost("num_tarjeta"),
            "id_usuario" => $id_usuario, // ID del usuario actual
            "id_plan" => $this->session->get('id_plan')  //ID del plan desde sesión
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
