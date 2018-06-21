<?php

class Otpremnica extends MainController
{
    function __construct() {
        parent::__construct();
    }
     
    function index(){
        $result = $this->model->index();
        if (!empty($result->otpremnice)) {
            $this->view->otpremnice = $result->otpremnice;
            $this->view->render('otpremnica/index');
        } else {
            $this->view->message = 'Ne postoji nijedna otpremnica';
            $this->view->render('error/error_detalji');
        }
    }
          
    function otpremnicaDetalji($id){
        $result = $this->model->otpremnicaDetalji($id);
        if (!empty($result->otpremnica)) {
            $this->view->otpremnica = $result;
            $this->view->render('otpremnica/otpremnica_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji otpremnica sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }
}