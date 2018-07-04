<?php

class Roba extends MainController {

    function __construct() {
        parent::__construct();
        $this->view->js = array('roba/js/ucitajKombo.js');
    }

    function novaRoba() {
        $this->view->render('roba/dodaj_novu_robu');
    }

    function dodajNovuRobu() {
        $naziv = filter_input(INPUT_POST, 'naziv');
        $kolicina = filter_input(INPUT_POST, 'kolicina');
        $sekcija = filter_input(INPUT_POST, 'sekcija');
        $vrsta_robe = filter_input(INPUT_POST, 'vrsta_robe');
        $stringValidator = new Field((new StringValidator())->setMinLength(1));
        $kolicinaValidator = new Field((new NumberValidator())->setInteger());
        if ($stringValidator->isValid($naziv) && $kolicinaValidator->isValid($kolicina) && !empty($sekcija) 
                && $stringValidator->isValid($vrsta_robe) && $sekcija != 0 ) {            
            $result = $this->model->dodajNovuRobu($naziv, $kolicina, $sekcija, $vrsta_robe);
            if ($result != 0) {
                header('location: ../roba/prijemniList/' . $result);
            } else {
                $this->view->message = 'Doslo je do greske pri unosu robe';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

    function robaDetalji($id) {

        $this->view->roba = $this->model->robaDetalji($id);
        $this->view->render('roba/roba_detalji');
    }

    function prijemniList($id) {
        $this->view->prijemniList = $this->model->prijemniList($id);
        $this->view->render('roba/prijemni_list');
    }

    function prebaciRobu($id) {
        $this->view->sekcija = $this->model->prijemniList($id);
        $this->view->render('roba/prebaci_robu');
    }

    function prebaciRobuUDruguSekciju() {
        $roba_id = filter_input(INPUT_POST, 'roba_id');
        $sekcija_start = filter_input(INPUT_POST, 'sekcija_start');
        $sekcija = filter_input(INPUT_POST, 'sekcija');
        if (!empty($roba_id) && !empty($sekcija_start) &&  !empty($sekcija) && $sekcija != 0) {            
            if ($sekcija_start == $sekcija) {
                $this->view->message = 'Roba se vec nalazi u prosledjenoj sekciji';
                $this->view->render('error/error_detalji');
            } else {
                $result = $this->model->zapamtiUIstoriji($roba_id, $sekcija_start, $sekcija);
                if ($result > 0) {
                    header('location: ../roba/robaDetalji/' . $result);
                } else {
                    $this->view->message = 'Doslo je do greske pri premestaju robe';
                    $this->view->render('error/error_detalji');
                }
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nisu prosledjeni ispravni parametri';
            $this->view->render('error/error_detalji');
        }
    }

    function IznesiRobuIzMagacina($id) {
        $this->model->otpremniList($id);
    }

    function IznesiRobu($id) {
        $this->view->roba = $this->model->robaDetalji($id);
        $this->view->render('roba/izlaz_robe');
    }

}
