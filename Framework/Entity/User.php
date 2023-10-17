<?php

namespace Framework\Entity;

class User
{

    private $user_ID;
    private $password;
    private $username;
    private $first_connexion;
    private $last_connexion;
    private $admin;

    public function __construct($user_ID, $username, $password,$first_connexion,$last_connexion, $admin)
    {
        $this->user_ID = $user_ID;
        $this->password = $password;
        $this->username = $username;
        $this->first_connexion = $first_connexion;
        $this->last_connexion = $last_connexion;
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->user_ID;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
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
    public function getAdmin(): mixed
    {
        return $this->admin;
    }

}
