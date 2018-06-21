<?php

class Predracun extends MainController
{
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $result = $this->model->index(); 
        if (!empty($result->predracuni)) {
            $this->view->predracuni = $result->predracuni;
            $this->view->render('predracun/index');
        } else {
            $this->view->message = 'Ne postoji nijedan predracun';
            $this->view->render('error/error_detalji');
        }
    }
    
    function predracunDetalji($id){
        $result = $this->model->predracunDetalji($id);
        if (!empty($result->predracun)) {
            $this->view->predracun = $result;
            $this->view->render('predracun/predracun_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji predracun sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }
}

