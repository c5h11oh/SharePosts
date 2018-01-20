<?php

//base controller.
//loads the models and views

class Controller {
    //load model
    public function model($model){
        //require model file
        require_once("../app/models/" . $model . ".php");

        //instantiate
        return new $model();
    }

    //load view
    public function view($view, $data = []){
        //check if the view exists
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else
            die('The view ' . $view . ' does not exists.');
    }
}