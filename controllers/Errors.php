<?php

class Errors extends MainController
{
    function __construct(){
        parent::__construct();
        $this->view->render('error/index');
    }
}

