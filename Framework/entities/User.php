<?php

namespace entities;

include_once 'Entity.php';

class User extends Entity
{
    private $user_ID;
    private $password;
    private $username;
    private $first_connexion;
    private $last_connexion;
    private $level;

    public function getUser_ID()
    {
        return $this->user_ID;
    }

    public function setUser_ID($user_ID)
    {
        $user_ID = (int)$user_ID;
        if ($user_ID > 0) {
            $this->user_ID = $user_ID;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    public function getFirst_connexion()
    {
        return $this->first_connexion;
    }

    public function setFirst_connexion($first_connexion)
    {
        $this->first_connexion = $first_connexion;
    }

    public function getLast_connexion()
    {
        return $this->last_connexion;
    }

    public function setLast_connexion($last_connexion)
    {
        $this->last_connexion = $last_connexion;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $level = (int)$level;
        if ($level === 0 || $level === 1 || $level === 2) {
            $this->level = $level;
        }
    }
}