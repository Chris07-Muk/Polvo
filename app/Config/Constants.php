<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * Define a constant
 * define('CONSTANT_NAME', 1000);
 * define('CONSTANT_NAME', 'AAA' || 'A');
 * define('CONSTANT_NAME', array());
 * 
 */

 // app/Config/Constants.php
define('RECURSOS_USUARIO_CSS', 'recursos_usuario/css');
define('RECURSOS_USUARIO_JS', 'recursos_usuario/js');
define('RECURSOS_USUARIO_IMG', 'recursos_usuario/img');
define('RECURSOS_USUARIO_FONTS', 'recursos_usuario/fonts');

 

define('RECURSOS_PANEL_ADMIN_CSS', 'recursos_panel_admin/dist/css');
define('RECURSOS_PANEL_ADMIN_JS', 'recursos_panel_admin/dist/js');
define('RECURSOS_PANEL_ADMIN_IMG', 'recursos_panel_admin/dist/img');
define('RECURSOS_PANEL_ADMIN_PLUGINS', 'recursos_panel_admin/plugins');
define('RECURSOS_PANEL_IMG_PROFILES_USER', 'images/profile_user/');


define('MASCULINO', 1);
define('FEMENINO', 0);

define ('ESTATUS_HABILITADO', 1);
define ('ESTATUS_DESHABILITADO', 0);

define('SUCCESS_ALERT', 'success');//verde
define('WARNING_ALERT', 'warning');//amarillo
define('INFO_ALERT', 'info');//azul
define('ERROR_ALERT', 'error');//rojo

define('TAREA_DASHBOARD', 'tarea_dashboard');

define('TAREA_USUARIOS', 'tarea_usuarios');
define("TAREA_PLANES", "planes");
define("TAREA_GENEROS", "generos");
define("TAREA_STREAMING", "streaming");
define("TAREA_VIDEOS", "videos");
define("TAREA_PAGOS", "pagos");
define("TAREA_USUARIOS_PLANES", "usuarios_planes");
define("TAREA_ALQUILERES", "alquileres");
define('TAREA_CLIENTES', 'tarea_clientes');


// Permisos para el Administrador
define('PERMISOS_ADMINISTRADOR', array(
    TAREA_DASHBOARD,
    TAREA_USUARIOS,
    TAREA_PLANES,
    TAREA_GENEROS,
    TAREA_STREAMING,
    TAREA_VIDEOS,
    TAREA_PAGOS,
    TAREA_USUARIOS_PLANES,
    TAREA_ALQUILERES
));

define('PERMISOS_OPERADOR', array(
    TAREA_DASHBOARD,
    TAREA_CLIENTES,       
    TAREA_PAGOS           
));


define('PERMISOS_CLIENTE', array(
    TAREA_DASHBOARD,
    TAREA_ALQUILERES,     
    TAREA_PAGOS,         
    TAREA_VIDEOS          
));


define('ROL_ADMINISTRADOR', array("clave" => 745 , "rol" => "Administrador"));
define('ROL_OPERADOR', array("clave" => 125 , "rol" => "Operador"));
define('ROL_CLIENTE', array("clave" => 58 , "rol" => "Cliente"));

//ROLES
define("ROLES", array(
    ROL_ADMINISTRADOR["clave"] => ROL_ADMINISTRADOR["rol"],
    ROL_OPERADOR["clave"] => ROL_OPERADOR["rol"],
    ROL_CLIENTE["clave"] => ROL_CLIENTE["rol"],
));



define('RECURSOS_PANEL_BSB_JS', 'recursos_panel_bsb\js');
define('RECURSOS_PANEL_BSB_CSS', 'recursos_panel_bsb\css');
define('RECURSOS_PANEL_BSB_PLUGINS', 'recursos_panel_bsb\plugins');



//Constantes para el portal
define('RECURSOS_PORTAL_CSS', 'recursos_portal/css/');
define('RECURSOS_PORTAL_FONTS', 'recursos_portal/fonts/');
define('RECURSOS_PORTAL_IMAGES', 'recursos_portal/img/');
define('RECURSOS_PORTAL_JS', 'recursos_portal/js/');


//rutas para los videos
define('RECURSOS_STREAM_IMG', 'streaming/caratulas/');
define('RECURSOS_STREAM_VID', 'streaming/trailers/');


