<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends MainController {

    function __construct() {
        parent::__construct();
        Session::init();
        $loggedIn = Session::get('loggedIn');
        if ($loggedIn == FALSE) {
            Session::destroy();
            header('location: ../');
            exit();
        }
    }

    function index() {
        $filter = filter_input(INPUT_POST, 'filter', FILTER_SANITIZE_STRING);
        $this->view->roba = $this->model->robaSearch($filter);
        $this->view->render('dashboard/index');
    }

    function logout() {
        Session::destroy();
        header('location: ../');
        exit();
    }

}
