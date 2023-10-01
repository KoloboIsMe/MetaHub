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

    public function __construct($data){
//        foreach ($data as $key => $value) {
//            if (!isset($value)) {
//                $data[$key] = NULL;
//            }
//        }
        $this->ID = $data['ID'];
        $this->password = $data['PASSWORD'];
        $this->img = $data['IMG_ID'];
        $this->username = $data['USERNAME'];
        $this->first_connexion = $data['FIRST_CONNEXION'];
        $this->last_connexion = $data['LAST_CONNEXION'];
    }

    public function showData(){
        echo $this->ID . " " . $this->password . " " . $this->img . " " . $this->username . " " . $this->first_connexion . " " . $this->last_connexion;
    }

    public function getID(): mixed
    {
        return $this->ID;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    public function getImg(): mixed
    {
        return $this->img;
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