<?php

namespace service;

class UsersGetting
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function addUserById($dataccess, $id)
    {
        $users = $dataccess->getUserById($id);
        $this->outputData->addOutputDataUsers($users, $id);
    }

    public function resetOutputDataUsers()
    {
        $this->outputData->resetOutputDataUsers();
    }

    public function authentificate($username, $password, $dataccess)
    {
        $users = $dataccess->isUser($username, $password);
        $this->outputData->setOutputDataUsers($users);
    }

    public function register($username, $password, $dataccess)
    {
        return $dataccess->register($username, $password, date("Y-m-d"));

    }
}