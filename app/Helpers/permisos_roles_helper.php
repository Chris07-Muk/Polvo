<?php

    function acceso_usuario($tarea_actual = "", $rol_actual = ""){
        $permiso = TRUE;

        switch ($rol_actual) {
            case ROL_ADMINISTRADOR["clave"]:
                $permiso = in_array($tarea_actual,PERMISOS_ADMINISTRADOR);
                break;
                
            case ROL_OPERADOR["clave"]:
                $permiso = in_array($tarea_actual,PERMISOS_OPERADOR);
                break;
            
            default:
                $permiso = FALSE;
                break;
        }


        return $permiso;
    }