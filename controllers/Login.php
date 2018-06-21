<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends MainController {

    function __construct() {
        parent::__construct();
        Session::init();
        $loggedIn = Session::get('loggedIn');
        if ($loggedIn == true) {
            header('location: dashboard/index');
            exit();
        }
    }

    function index() {
        $this->view->render('login_page');
    }

    function loginIn($arg = false) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $regex = "/^.{6,}$/";
        if (preg_match($regex, $password)) {
            $result = $this->model->login($username, $password);
            if ($result == 1) {
                header('location: ../dashboard/index');
            }
        }
        header('location: ../');
    }

}
