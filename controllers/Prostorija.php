<?php

class Prostorija extends MainController {

    function __construct() {
        parent::__construct();
    }

    function novaProstorija($id) {
        $this->view->magacin_id = $id;
        $this->view->render('prostorija/dodaj_novu_prostoriju');
    }

    function dodajNovuProstoriju() {
        $magacin_id = filter_input(INPUT_POST, 'magacin_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($magacin_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->dodajNovuProstoriju($magacin_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu prostorije';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../magacin/magacinDetalji/' . $magacin_id);
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

    function prostorijaDetalji($id) {
        $result = $this->model->prostorijaDetalji($id);
        if (!empty($result->id)) {
            $this->view->prostorija = $result;
            $this->view->render('prostorija/prostorija_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji prostorija sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }

    function popuniKombo() {
        $mag_id = filter_input(INPUT_POST, 'magacin_id');        
        $this->model->popuniKombo($mag_id);
    }
    
    function izmenaProstorije($id) {
        $this->view->prostorija_id = $id;
        $this->view->render('prostorija/izmeni_prostoriju');
    }
    
    function izmeniProstoriju(){
        $prostorija_id = filter_input(INPUT_POST, 'prostorija_id');
        $broj = filter_input(INPUT_POST, 'broj');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        if (!empty($prostorija_id) && $stringValidator->isValid($broj)) {            
            $result = $this->model->izmeniProstoriju($prostorija_id, $broj);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri upisu prostorije';
                $this->view->render('error/error_detalji');
            } else {
                header('location: ../prostorija/prostorijaDetalji/' . $prostorija_id);
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

}
