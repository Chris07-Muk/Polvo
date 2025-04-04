<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use App\Models\Tabla_UsuariosPlanes;
use App\Models\Tabla_Planes;

class Plan extends BaseController
{
    private $view = 'usuario/plan';
    private $session;

    public function __construct()
    {
        $this->session = session();
    }

    private function load_data()
    {
        $data = [
            'nombre_pagina' => 'Planes',
            'titulo_pagina' => 'Mi Plan Actual',
            'is_logged' => $this->session->get('is_logged')
        ];

        helper('message');

        $tabla_pagos = new \App\Models\Tabla_Pagos();
        $data['estatus_pago'] = $tabla_pagos->ultimo_pago_usuario($this->session->get('id_usuario'))->estatus_pago ?? null;

        return $data;
    }

    private function create_view($name_view = '', $content = [])
    {
        return view($name_view, $content);
    }

    // =======================
    // Vista del plan actual
    // =======================
    public function index()
    {
        if (!session('is_logged')) {
            return redirect()->to(route_to('portal'));
        }

        $modelo_usuarios_planes = new Tabla_UsuariosPlanes();
        $data = $this->load_data();
        $data["plan_usuario"] = $modelo_usuarios_planes->plan_usuario($this->session->get('id_usuario'));

        return $this->create_view($this->view, $data);
    }

    // =======================
    // Planes disponibles para contratar
    // =======================
    public function disponibles()
    {
        if (!session('is_logged')) {
            return redirect()->to(route_to('portal'));
        }

        $modelo_planes = new Tabla_Planes();

        $data = $this->load_data();
        $data['planes_disponibles'] = $modelo_planes
            ->where('estatus_plan', 1)
            ->findAll();

        return $this->create_view('usuario/planes_disponibles', $data);
    }

    // =======================
    // Contratar un plan
    // =======================
    public function contratar($id_plan = null)
    {
        // Validación de sesión
        if (!session('is_logged')) {
            return redirect()->to(route_to('portal'));
        }


        // Validación de ID de usuario
        if (!$id_usuario = session('id_usuario')) {
            make_message(ERROR_ALERT, "Error de sesión", "No se encontró el ID del usuario en la sesión.");
            return redirect()->to(route_to("perfil"));
        }

        // Validación de plan
        if (null === $id_plan) {
            return redirect()->to(route_to('planes_disponibles'));
        }

        // Consulta de un plan
        $modelo_planes = new \App\Models\Tabla_Planes();
        $modelo_usuarios_planes = new \App\Models\Tabla_UsuariosPlanes();

        $plan = $modelo_planes->where('estatus_plan', 1)->find($id_plan);
        if (!$plan) {
            return redirect()->to(route_to('planes_disponibles'))->with('error', 'El plan no está disponible.');
        }

        // Calculo de fechas
        $dias = 30;
        switch ((int) $plan->tipo_plan) {
            case 8:
                $dias = 7;
                break;
            case 16:
                $dias = 30;
                break;
            case 32:
                $dias = 365;
                break;
        }

        $fecha_inicio = date('Y-m-d');
        $fecha_fin = date('Y-m-d', strtotime("+$dias days"));

        // Registro de un plan
        $modelo_usuarios_planes->insert([
            'id_usuario' => $id_usuario,
            'id_plan' => $id_plan,
            'fecha_registro_plan' => $fecha_inicio,
            'fecha_fin_plan' => $fecha_fin
        ]);

        // Actualizar los datos de la sesion
        $this->session->set('nombre_plan', $plan->nombre_plan);
        $this->session->set('dias_activo', $dias);
        $this->session->set('precio_plan', $plan->precio_plan);
        $this->session->set('id_plan', $plan->id_plan);

        return redirect()->to(route_to('planes_portal'))->with('success', '¡Plan contratado exitosamente!');
    }
}
