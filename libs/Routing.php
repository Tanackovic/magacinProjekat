<?php

class Routing
{
    function __construct() {        
        $url = filter_input(INPUT_GET, 'url');        
        $url = rtrim($url);
        $url = explode('/', $url);
        $file = 'controllers/' . $url[0] . ".php";
        
        if(empty($url[0])){
            require 'controllers/login.php';
            $controller = new Login();
            $controller->index();
            return false;
        }
        
        if(file_exists($file)){
            require $file;
        }
        else{
            $this->error();
            return false;
        }
        
        $controller = new $url[0];
        $controller->loadModel($url[0]);
        
        if(isset($url[2])){
            if(method_exists($controller, $url[1])){
                $controller->{$url[1]}($url[2]);
            }else{
                $this->error();
            }
        }
        else if (isset($url[1])){
            if(method_exists($controller, $url[1])){
                $controller->{$url[1]}();
            }else{
                $this->error();
            }
        }
    }
    
    function error(){
        require 'controllers/Errors.php';
        $controller = new Errors();
        return false;
    }
}
