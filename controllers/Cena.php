<?php

class Cena extends MainController {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $result = $this->model->vratiSveCene();
        if ($result == 0) {
            $this->view->render('cena/dodaj_cenu');
        } else {
            $this->view->cene = $result;
            $this->view->render('cena/index');
        }
    }

    function promeniCenu() {
        $this->view->render('cena/promeni_cenu');
    }

    function promeniCenuCuvanja() {
        $cena = doubleval(filter_input(INPUT_POST, 'cena')); 
        $regex = '^(-?)(0|([1-9][0-9]*))(\\.[0-9]+)?$^';
        if (!empty($cena) && preg_match($regex, $cena) && $cena>0) {         
            $result = $this->model->promeniCenu($cena);
            if ($result > 0) {
                $this->index();
            } else {
                $this->view->message = 'Doslo je do greske pri unosu nove cene';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni';
            $this->view->render('error/error_detalji');
        }
    }
    
    function dodajCenu() {

        $cena = doubleval(filter_input(INPUT_POST, 'cena'));     
        if (!empty($cena)) {  

            $result = $this->model->dodajCenu($cena);
            if ($result > 0) {
                $this->index();
            } else {
                $this->view->message = 'Doslo je do greske pri unosu nove cene';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni';
            $this->view->render('error/error_detalji');
        }
    }

}
