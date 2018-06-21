<?php

class Polica extends MainController {

    function __construct() {
        parent::__construct();
    }

    function novaPolica($id) {
        $this->view->prostorija_id = $id;
        $this->view->render('polica/dodaj_novu_policu');
    }

    function dodajNovuPolicu() {
        $prostorija_id = filter_input(INPUT_POST, 'prostorija_id');
        $broj = filter_input(INPUT_POST, 'broj');
        if (!empty($prostorija_id) && !empty($broj)) {            
            $result = $this->model->dodajNovuPolicu($prostorija_id, $broj);
            if($result == 0){
                $this->view->message = 'Doslo je do greske pri upisu police';
                $this->view->render('error/error_detalji');
            }else{
                header('location: ../prostorija/prostorijaDetalji/' . $prostorija_id );
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

    function policaDetalji($id) {
        $result = $this->model->policaDetalji($id);
        if (!empty($result->id)) {
            $this->view->polica = $result;
            $this->view->render('polica/polica_detalji');
        } else {
            $this->view->message = 'Doslo je do greske: Ne postoji polica sa id = ' . $id;
            $this->view->render('error/error_detalji');
        }        
    }

    function popuniKombo() {
        $prostorija_id = filter_input(INPUT_POST, 'prostorija_id');        
        $this->model->popuniKombo($prostorija_id);
    }
    
    function izmenaPolice($id) {
        $this->view->polica_id = $id;
        $this->view->render('polica/izmeni_policu');
    }

    function izmeniPolicu(){
        $polica_id = filter_input(INPUT_POST, 'polica_id');
        $broj = filter_input(INPUT_POST, 'broj');
        if (!empty($polica_id) && !empty($broj)) {            
            $result = $this->model->izmeniPolicu($polica_id, $broj);
            if($result == 0){
                $this->view->message = 'Doslo je do greske pri izmeni police';
                $this->view->render('error/error_detalji');
            }else{
                header('location: ../polica/policaDetalji/' . $polica_id );
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }
}
