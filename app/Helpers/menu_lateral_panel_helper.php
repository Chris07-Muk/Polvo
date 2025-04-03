<?php

/**
 * permite crear la cracion e instancia de
 * nuestro menu panel lateral de manera dinamica
 * [menu]
 * [Opcion A]
 * [Opcion B]
 *     [Opcion B1]
 *     [Opcion B2]
 * 
 * [Opcion C]
 *     [Opcion C1]
 *         [Opcion C1.1]
 */
function configurar_menu_panel($tarea_actual = '', $rol_actual = 0)
{
    
    
        $menu = array();
        $menu_opcion = array();
    
        // Dashboard
        $menu_opcion['is_active'] = ($tarea_actual == TAREA_DASHBOARD);
        $menu_opcion['href'] = route_to("dashboard");
        $menu_opcion['text'] = 'Dashboard';
        $menu_opcion['icon'] = 'fa fa-tachometer-alt';
        $menu_opcion['submenu'] = array();
        $menu['dashboard'] = $menu_opcion;
    
        // ========================
        // ROL ADMINISTRADOR
        // ========================
        if ($rol_actual == ROL_ADMINISTRADOR["clave"]) {
    
            // Usuarios
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_USUARIOS);
            $menu_opcion['href'] = route_to("usuarios");
            $menu_opcion['text'] = 'Usuarios';
            $menu_opcion['icon'] = 'fa fa-users';
            $menu_opcion['submenu'] = array();
            $menu['usuarios'] = $menu_opcion;
    
            // Géneros
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_GENEROS);
            $menu_opcion['href'] = route_to("generos");
            $menu_opcion['text'] = 'Géneros';
            $menu_opcion['icon'] = 'fa fa-tags';
            $menu_opcion['submenu'] = array();
            $menu['generos'] = $menu_opcion;
    
            // Streaming
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_STREAMING);
            $menu_opcion['href'] = route_to("streaming");
            $menu_opcion['text'] = 'Streaming';
            $menu_opcion['icon'] = 'fa fa-play-circle';
            $menu_opcion['submenu'] = array();
            $menu['streaming'] = $menu_opcion;
            //Videos
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_VIDEOS);
            $menu_opcion['href'] = route_to("videos");
            $menu_opcion['text'] = 'Videos';
            $menu_opcion['icon'] = 'fa fa-video';
            $menu_opcion['submenu'] = array();
            $menu['videos'] = $menu_opcion;
    
            // Usuarios Planes
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_USUARIOS_PLANES);
            $menu_opcion['href'] = route_to("usuarios_planes");
            $menu_opcion['text'] = 'Usuarios Planes';
            $menu_opcion['icon'] = 'fa fa-id-card-alt';
            $menu_opcion['submenu'] = array();
            $menu['usuarios_planes'] = $menu_opcion;
    
            // Planes
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_PLANES);
            $menu_opcion['href'] = route_to("planes");
            $menu_opcion['text'] = 'Planes';
            $menu_opcion['icon'] = 'fa fa-list-alt';
            $menu_opcion['submenu'] = array();
            $menu['planes'] = $menu_opcion;
            
        }
    
        // ========================
        // ROL OPERADOR
        // ========================
        if ($rol_actual == ROL_OPERADOR["clave"]) {
    
            // Clientes (usuarios)
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_CLIENTES);
            $menu_opcion['href'] = route_to("clientes");
            $menu_opcion['text'] = 'Clientes';
            $menu_opcion['icon'] = 'fa fa-user-check';
            $menu_opcion['submenu'] = array();
            $menu['usuarios'] = $menu_opcion;
    
            // Validar Pagos
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_PAGOS);
            $menu_opcion['href'] = route_to("pagos");
            $menu_opcion['text'] = 'Pagos Clientes';
            $menu_opcion['icon'] = 'fa fa-credit-card';
            $menu_opcion['submenu'] = array();
            $menu['pagos'] = $menu_opcion;
    
            // Ver Alquileres
            $menu_opcion = array();
            $menu_opcion['is_active'] = ($tarea_actual == TAREA_ALQUILERES);
            $menu_opcion['href'] = route_to("alquileres");
            $menu_opcion['text'] = 'Alquiler';
            $menu_opcion['icon'] = 'fa fa-film';
            $menu_opcion['submenu'] = array();
            $menu['alquileres'] = $menu_opcion;
        }
    
        return $menu;
    }
    
 //end configurar_menu_panel//end configurar_menu_panel

function crear_menu_panel($tarea_actual = '', $rol_actual = 0)
{
    $menu = configurar_menu_panel($tarea_actual, $rol_actual);
    //d($menu);
    $html = '';
    $html .= '
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav nav-header">Menu Lateral</li>';
    foreach ($menu as $opcion) {
        //dd($opcion);
        if ($opcion["href"] != "#") {
            $html .= '
                        <li class="nav-item">
                            <a href="' . $opcion["href"] . '" class="nav-link ' . (($opcion["is_active"] == TRUE) ? "active" : "") . '">
                                <i class="nav-icon ' . $opcion["icon"] . '"></i>
                                <p>' . $opcion["text"] . '</p>
                            </a>
                        </li>
                    ';
        } //end if
        else {
            $html .= '
                        <li class="nav-item">
                            <a href="#" class="nav-link ' . (($opcion["is_active"] == TRUE) ? "active" : "") . '">
                                <i class="nav-icon ' . $opcion["icon"] . '"></i>
                                <p>
                                    ' . $opcion["text"] . '
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>';
            if (sizeof($opcion["submenu"]) > 0) {
                $html .= '<ul class="nav nav-treeview">';
                foreach ($opcion["submenu"] as $sub_opcion_menu) {
                    $html .= '
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ' . (($sub_opcion_menu["is_active"] == TRUE) ? "active" : "") . '">
                                                <i class="' . $sub_opcion_menu["icon"] . ' nav-icon"></i>
                                                <p>' . $sub_opcion_menu["text"] . '</p>
                                            </a>
                                        </li>
                                    ';
                } //end foreach subopcion
                $html .= '</ul>';
            } //end if sizeof
            $html .= '</li>
                    ';
        } //end else
    }
    $html .= '</ul>';
    return $html;
}// end crear_menu_panel