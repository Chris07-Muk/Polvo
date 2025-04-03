<?php
    /**
     * how to declare a new function into helper
     * function namefunction(arguments){
     * //statement
     * return 0;
     * }//end namefunction
     */

    function breadcrumb_panel($titulo_pagina = '', $breadcrumb = array()){
        $html = '';
        $html.= '
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">'.$titulo_pagina.'</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="'.route_to("dashboard").'"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>';
                    //dd ($breadcrumb);
                    foreach ($breadcrumb as $bd) {
                        if ($bd["href"] != "#") {
                            $html.= '<li class="breadcrumb-item"><a href="'.$bd["href"].'">'.$bd["titulo"].'</a></li>';
                        }//end if
                        else {
                            $html.= '<li class="breadcrumb-item active">'.$bd["titulo"].'</li>';
                        }//end else
                    }//end foreach
                $html.='</ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        ';
        return $html;
    }//end breadcrumb_panel