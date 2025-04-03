<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use App\Models\Tabla_Alquileres;
use App\Models\Tabla_UsuariosPlanes;

class Alquiler extends BaseController
{
    private $session;

    public function __construct()
    {
        $this->session = session();
        helper('message');
    }

    public function index()
    {
        if (!$this->session->get('is_logged')) {
            make_message(WARNING_ALERT, 'Se necesita acceso', 'Inicia sesión para ver el contenido.');
            return redirect()->to(route_to('portal'));
        }

        $id_usuario = $this->session->get('id_usuario');

        // 1. Actualizar alquileres vencidos
        $this->actualizarAlquileresVencidos($id_usuario);

        // 2. Contar alquileres activos
        $alquileresModel = new Tabla_Alquileres();
        $alquileres_activos = $alquileresModel
            ->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', 1)
            ->countAllResults();

        if ($alquileres_activos >= 10) {
            make_message(INFO_ALERT, 'Límite alcanzado', 'Has alcanzado el límite de 10 alquileres. Renueva tu plan.');
            return redirect()->to(route_to('pagos_portal'));
        }

        // 3. Verificar vigencia del plan
        $modelo_planes = new Tabla_UsuariosPlanes();
        $plan = $modelo_planes->plan_usuario($id_usuario);

        if ($plan) {
            $fecha_actual = date('Y-m-d');
            if ($fecha_actual > $plan->fecha_fin_plan) {
                make_message(WARNING_ALERT, 'Plan vencido', 'Tu plan ha vencido. Renueva para continuar.');
                return redirect()->to(route_to('pagos_portal'));
            }
        } else {
            make_message(WARNING_ALERT, 'Sin plan activo', 'Debes contratar un plan para alquilar contenido.');
            return redirect()->to(route_to('pagos_portal'));
        }

        // Si pasó todas las validaciones, puede continuar viendo
        make_message(SUCCESS_ALERT, 'Acceso permitido', 'Puedes ver el contenido.');
        return redirect()->to(route_to('generos'));
    }

    private function actualizarAlquileresVencidos($id_usuario)
    {
        $alquileresModel = new Tabla_Alquileres();

        $alquileres_vencidos = $alquileresModel
            ->where('id_usuario', $id_usuario)
            ->where('estatus_alquiler', 1)
            ->where('fecha_fin_alquiler <', date('Y-m-d'))
            ->findAll();

        foreach ($alquileres_vencidos as $alquiler) {
            $alquileresModel->update($alquiler->id_alquiler, [
                'estatus_alquiler' => -1
            ]);
        }
    }
}