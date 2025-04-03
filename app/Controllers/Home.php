<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * How to declare a function
     * [ma] function  name(arguments){
     *      //Stament
     *      return ;
     * }
     */
    //Main function : index
    public function index()
    {
        return view('welcome_message');
    }

    public function example(){
        //Show a String
        // echo "It's working";

        //Calling a other method
        return $this->index();
    }
}
