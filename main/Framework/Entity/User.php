<?php

namespace Entity;

class User
{
    private $ID;
    private $password;
    private $username;
    private $first_connexion;
    private $last_connexion;

    public function __construct($ID = null, $username, $password,$first_connexion = null,$last_connexion = null)
    {
        $this->ID = $ID;
        $this->password = $password;
        $this->username = $username;
        $this->first_connexion = $first_connexion;
        $this->last_connexion = $last_connexion;
    }

//        $this->ID = $data['ID'];
//        $this->password = $data['PASSWORD'];
//        $this->username = $data['USERNAME'];
//        $this->first_connexion = $data['FIRST_CONNEXION'];
//        $this->last_connexion = $data['LAST_CONNEXION'];
//    }

    public function getID(): mixed
    {
        return $this->ID;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    public function getUsername(): mixed
    {
        return $this->username;
    }

    public function getFirstConnexion(): mixed
    {
        return $this->first_connexion;
    }

    public function getLastConnexion(): mixed
    {
        return $this->last_connexion;
    }
}