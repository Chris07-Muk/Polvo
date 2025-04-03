<?php
    function make_message($type = '', $desc = '', $title = ''){
        session();
        $message = array(
            'title'=> $title,
            'description'=> $desc,
            'type'=> $type,

        );
        session()->set('message', $message);


    }//end make_message

    function show_message(){
        $html = '';
        $message = session()->get('message');
        if ($message == null) {
            return $html;
        }
        // $tipo_mensage = '';
        // switch ($tipo_mensage) {
        //     case 50:
        //         $tipo_mensage = 'success';
        //         break;
        //     case 100:
        //         $tipo_mensage = 'error';
        //         break;
        //     case 125:
        //         $tipo_mensage = 'warning';
        //         break;
            
        //     default:
        //         $tipo_mensage = 'info';
        //         break;
        // }
        // $html .= 'toastr.'.$tipo_mensage.'("'.$message['description'].'", "'.$message['title'].'")';
        $html .= 'toastr.'.$message['type'].'("'.$message['description'].'", "'.$message['title'].'")';
        session()->remove('message');
        return $html;

    }