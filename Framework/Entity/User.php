<?php

namespace Entity;

class User
{
    private $ID;
    private $password;
    private $img;
    private $username;
    private $first_connexion;
    private $last_connexion;

    public function __construct($ID, $password, $img, $username, $first_connexion, $last_connexion){
        $this->ID = $ID;
        $this->password = $password;
        $this->img = $img;
        $this->username = $username;
        $this->first_connexion = $first_connexion;
        $this->last_connexion = $last_connexion;
    }

    public function showData(){
        echo $this->ID . " " . $this->password . " " . $this->img . " " . $this->username . " " . $this->first_connexion . " " . $this->last_connexion;
    }


}