<?php

namespace entities;

include_once 'Entity.php';

class User extends Entity
{
    /**
     * @var
     */
    private $user_ID;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $first_connexion;
    /**
     * @var
     */
    private $last_connexion;
    /**
     * @var
     */
    private $level;

    /**
     * @return int
     */
    public function getUser_ID()
    {
        return $this->user_ID;
    }

    /**
     * @param $user_ID
     * @return void
     */
    public function setUser_ID($user_ID)
    {
        $user_ID = (int)$user_ID;
        if ($user_ID > 0) {
            $this->user_ID = $user_ID;
        }
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return void
     */
    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return void
     */
    public function setUsername($username)
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    /**
     * @return string
     */
    public function getFirst_connexion()
    {
        return $this->first_connexion;
    }

    /**
     * @param $first_connexion
     * @return void
     */
    public function setFirst_connexion($first_connexion)
    {
        $this->first_connexion = $first_connexion;
    }

    /**
     * @return string
     */
    public function getLast_connexion()
    {
        return $this->last_connexion;
    }

    /**
     * @param $last_connexion
     * @return void
     */
    public function setLast_connexion($last_connexion)
    {
        $this->last_connexion = $last_connexion;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param $level
     * @return void
     */
    public function setLevel($level)
    {
        $level = (int)$level;
        if ($level === 0 || $level === 1 || $level === 2) {
            $this->level = $level;
        }
    }
}