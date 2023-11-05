<?php

namespace service;

class UsersGetting
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
    public function existsUsername($dataccess, $username)
    {
        return $dataccess->existsUsername($username);
    }

    public function existsUser($dataccess, $user_ID)
    {
        return $dataccess->existsUser($user_ID);
    }
    public function authenticate($username, $password, $dataccess)
    {
        $isUser = $dataccess->isUser($username, $password);
        $this->outputData->setOutputData($isUser);
    }

    public function register($username, $password, $dataccess)
    {
        return $dataccess->register($username, $password, date("Y-m-d H:i"));
    }
    public function updateUser($username, $password, $dataccess)
    {
        return $dataccess->updateUser($username, $password, $_SESSION['user_ID']);
    }

    public function getUserByUsername($dataccess, $username)
    {
        return $dataccess->getUserByUsername($username);
    }

    public function updateLastConnexion($dataccess, $user_ID)
    {
        $dataccess->updateLastConnexion($user_ID);
    }

    public function getUsers($dataccess)
    {
        $users = [];
        foreach ($dataccess->getUsersID() as $userId) {
            $users[] = $dataccess->getUserById($userId);
        }
        $this->outputData->setOutputData($users);
    }

    public function getUserById($dataccess, $id)
    {
        return $dataccess->getUserById($id);
    }

    public function setUserById($dataccess, $id)
    {
        $this->outputData->setOutputData($dataccess->getUserById($id));
    }
}