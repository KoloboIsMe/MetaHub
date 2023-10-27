<?php

namespace service;

class UsersGetting
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticate($username, $password, $dataccess)
    {
        $isUser = $dataccess->isUser($username, $password);
        $this->outputData->setOutputData($isUser);
    }

    public function register($username, $password, $dataccess)
    {
        return $dataccess->register($username, $password, date("Y-m-d"));
    }

    public function getUserByUsername($dataccess, $username)
    {
        return $dataccess->getUserByUsername($username);
    }

    public function updateLastConnexion($dataccess, $user_ID)
    {
        $dataccess->updateLastConnexion($user_ID);
    }
}