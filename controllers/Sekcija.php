<?php

class Sekcija extends MainController
{
    function __construct() {
        parent::__construct();
    }
     
    function novaSekcija($id){
        $this->view->red_id = $id;
        $this->view->render('sekcija/dodaj_novu_sekciju');
    }
    
    function dodajNovuSekciju(){
        $red_id = filter_input(INPUT_POST, 'red_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($red_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->dodajNovuSekciju($red_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu sekcije';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../red/redDetalji/' . $red_id);
            }
        }else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }
    
    function sekcijaDetalji($id){
        $result = $this->model->sekcijaDetalji($id);
        if (!empty($result->id)) {
            $this->view->sekcija = $result;
            $this->view->render('sekcija/sekcija_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji sekcija sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }
    
    function popuniKombo(){
       $red_id = filter_input(INPUT_POST, 'red_id');
       $this->model->popuniKombo($red_id);
    }
    
    function izmenaSekcije($id){
        $this->view->sekcija_id = $id;
        $this->view->render('sekcija/izmeni_sekciju');
    }
    
    function izmeniSekciju(){
        $sekcija_id = filter_input(INPUT_POST, 'sekcija_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($sekcija_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->izmeniSekciju($sekcija_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu sekcije';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../sekcija/sekcijaDetalji/' . $sekcija_id);
            }
        }else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }
}