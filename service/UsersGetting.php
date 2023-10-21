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
}