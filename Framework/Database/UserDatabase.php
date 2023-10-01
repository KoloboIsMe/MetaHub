<?php

namespace Database;

use Entity\User;

require_once('DataBaseConnexion.php');
require('AllDatabase.php');
require_once('Framework/Entity/User.php');

class UserDatabase extends AllDatabase
{
    public function __construct()
    {
        parent::__construct('user');
    }
    public function selectUser($attribute, $data)
    {
        $data = parent::select($attribute, $data);
        if (count($data) == 0) {
            return $data;
        }
        $users = [];
        $cpt = 0;
        foreach ($data as $user) {
            $users[$cpt] = new User($user);
            $cpt++;
        }
        return $users;
    }

    public function selectFromUsername($username)
    {
        return $this->selectUser('username', $username);
    }
    public function selectFromFirstConnexion($firstConnexion)
    {
        return $this->selectUser('FIRST_CONNEXION', $firstConnexion);
    }



}