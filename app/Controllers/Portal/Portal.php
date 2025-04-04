<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

use App\Models\Tabla_Streaming;


class Portal extends BaseController
{
    private $view = 'portal/portal';  // Vista que se va a cargar
    private $session = null;
    public function __construct()
    {
        $this->session = session();
        helper("message");
    }

    // Función para cargar los datos que se pasarán a la vista
    private function load_data(){
        $data = array();
        
        // Datos de la página
        $data['nombre_pagina'] = 'Blockbuster';  // Nombre de la página
        $data['titulo_pagina'] = 'Blockbuster';  // Título de la página
        $data['is_logged'] = $this->session->is_logged; //verificación de loggeado
        
        $modeloStreaming = new Tabla_Streaming();

        // Cargar streamings recientes
        $data['recientes'] = $modeloStreaming->get_recientes(3);
       // dd($data['recientes']);

        return $data;
    }

    // Función que se encarga de cargar la vista
    private function make_view($name_view = '', $content = array()){
        return view($name_view, $content);  // Llama a la vista con los datos
    }

    // Método por defecto que se llama cuando se accede a esta ruta
    public function index()
    {
        // Carga la vista portal/portal.php y le pasa los datos obtenidos de load_data()
        return $this->make_view($this->view, $this->load_data());
    }
}
