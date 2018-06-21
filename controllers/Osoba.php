<?php

class Osoba extends MainController {

    function __construct() {
        parent::__construct();
        Session::init();
        $uloga = Session::get('uloga');
        if ($uloga != '1') {
            header('location: ../dashboard/index');
            exit();
        }
    }

    function index() {
        $result = $this->model->vratiSveOsobe();
        if ($result == 0) {
            $this->view->message = 'Nema unetih osoba';
            $this->view->render('error/error_detalji');
        } else {
            $this->view->osoblje = $result;
            $this->view->render('osoblje/index');
        }
    }

    function NovaOsoba() {
        $this->view->render('osoblje/dodaj_novu_osobu');
    }

    function DodajNovuOsobu() {
        $ime = filter_input(INPUT_POST, 'ime');
        $prezime = filter_input(INPUT_POST, 'prezime');
        $korisnicko_ime = filter_input(INPUT_POST, 'korisnicko_ime');
        $password = filter_input(INPUT_POST, 'password');
        $uloga = filter_input(INPUT_POST, 'uloga');
        if (!empty($ime) && !empty($prezime) &&
                !empty($korisnicko_ime) && !empty($password) && !empty($uloga) && $uloga != 0) {            
            $result = $this->model->DodajNovuOsobu($ime, $prezime, $korisnicko_ime, $password, $uloga);
            if ($result == 1) {
                $this->index();
            } else {
                $this->view->message = 'Postoji osoba koja ima isto korisnicko ime';
                $this->view->render('error/error_detalji');
            }
        } else {
            $this->view->render('osoblje/dodaj_novu_osobu');
        }
    }

    function arhivaOsobe($id) {
        $result = $this->model->vratiOsobu($id);
        if ($result == 0) {
            $this->view->message = 'Ne postoji osoba sa id = ' . $id;
            $this->view->render('error/error_detalji');
        } else {
            $this->view->osoba = $result;
            $this->view->render('osoblje/arhiviraj_osobu');
        }
    }

    function arhivirajOsobu() {
        $id = filter_input(INPUT_POST, 'id');
        if (!empty($id)) {            
            $result = $this->model->arhivirajOsobu($id);
            if ($result == 0) {
                $this->view->message = 'Doslo je do greske pri arhiviranju osobe';
                $this->view->render('error/error_detalji');
            } else {
                $this->index();
            }
        } else {
            $this->view->message = 'Doslo je do greske: Nije prosledjen id osobe';
            $this->view->render('error/error_detalji');
        }
    }
}
