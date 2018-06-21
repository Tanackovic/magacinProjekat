<?php

class Magacin extends MainController {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $result = $this->model->vratiSveMagacine();
        if ($result == 0) {
            $this->view->render('magacin/dodaj_novi_magacin');
        } else {
            $this->view->magacini = $result;
            $this->view->render('magacin/index');
        }
    }

    function noviMagacin() {
        $this->view->render('magacin/dodaj_novi_magacin');
    }

    function dodajNoviMagacin() {
        $naziv = filter_input(INPUT_POST, 'naziv');
        $adresa = filter_input(INPUT_POST, 'adresa');
        if (!empty($naziv) && !empty($adresa)) {
            
            $result = $this->model->dodajNoviMagacin($naziv, $adresa);
            if ($result == 1) {
                $this->index();
            } else {
                $this->view->message = 'Doslo je do greske pri unosu magacina';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni';
            $this->view->render('error/error_detalji');
        }
    }

    function magacinDetalji($id) {
        $result = $this->model->magacinDetalji($id);
        if (!empty($result->id)) {
            $this->view->magacin = $result;
            $this->view->render('magacin/magacin_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji magacin sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }
    }

    function popuniKombo() {
        $this->model->popuniKombo();
    }
    
    function izmenaMagacina($id) {
        $this->view->magacin_id = $id;
        $this->view->render('magacin/izmeni_magacin');
    }
    
    function izmeniMagacin() {
        $magacin_id = filter_input(INPUT_POST, 'magacin_id');
        $naziv = filter_input(INPUT_POST, 'naziv');
        $adresa = filter_input(INPUT_POST, 'adresa');
        if (!empty($naziv) && !empty($adresa) && !empty($magacin_id)) {
            
            $result = $this->model->izmeniMagacin($magacin_id, $naziv, $adresa);
            if ($result == 1) {
                $this->index();
            } else {
                $this->view->message = 'Doslo je do greske pri unosu magacina';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni';
            $this->view->render('error/error_detalji');
        }
    }
}
