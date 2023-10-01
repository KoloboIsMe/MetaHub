<?php

namespace Database;

use Entity\User;

require_once('DataBaseConnexion.php');
require('AllTableDatabase.php');
require_once('Framework/Entity/User.php');

class UserDatabase extends AllTableDatabase
{
    public function __construct()
    {
        parent::__construct('user');
    }
    public function selectUser($attribute, $data)
    {
        $dbResult = parent::select($attribute, $data);
        $users = [];
        $cpt = 0;
        while($dbRow = mysqli_fetch_assoc($dbResult)){
            $users[$cpt] = new User($dbRow);
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