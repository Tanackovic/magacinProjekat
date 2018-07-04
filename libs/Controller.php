<?php

class MainController
{
    
    function __construct() {
        $this->view = new View();
        require 'Validators/NumberValidator.php';
        require 'Validators/StringValidator.php';
    }
    
    function loadModel($name){
        $path = 'models/' . $name . "_model.php";
        if(file_exists($path)){
            require 'models/' . $name . "_model.php";
            $modelName = $name . "_model";
            $this->model = new $modelName();
        }
    }
}