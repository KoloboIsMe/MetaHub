<?php

namespace App\Controllers;

use Framework\managers\UserManager;

class ConnexionController extends Controller
{
    public function login(){
        return $this->view('connexion.login');
    }

    public function register(){
        return $this->view('connexion.register');
    }
}