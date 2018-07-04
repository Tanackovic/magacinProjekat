<?php

class Red extends MainController {

    function __construct() {
        parent::__construct();
    }

    function noviRed($id) {
        $this->view->police_id = $id;
        $this->view->render('red/dodaj_novi_red');
    }

    function dodajNoviRed() {
        $polica_id = filter_input(INPUT_POST, 'polica_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($polica_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->dodajNoviRed($polica_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu reda';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../polica/policaDetalji/' . $polica_id);
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

    function redDetalji($id) {
        $result = $this->model->redDetalji($id);
        if (!empty($result->id)) {
            $this->view->red = $result;
            $this->view->render('red/red_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji red sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }

    function popuniKombo() {
        $polica_id = filter_input(INPUT_POST, 'polica_id');
        $this->model->popuniKombo($polica_id);
    }
    
    function izmenaReda($id) {
        $this->view->red_id = $id;
        $this->view->render('red/izmeni_red');
    }
    
    function izmeniRed(){
        $red_id = filter_input(INPUT_POST, 'red_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($red_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->izmeniRed($red_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu reda';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../red/redDetalji/' . $red_id);
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

}
