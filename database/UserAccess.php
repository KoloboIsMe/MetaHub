<?php

namespace database;

use entities\User;
use PDO;
use UserInterface;

include_once "service/UserInterface.php";
include_once "entities/User.php";

class UserAccess implements UserInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getUserById($ID)
    {
        $statement = $this->dataAccess->prepare('SELECT * FROM users where user_ID = :ID LIMIT 100');
        if(!$statement->execute([
            'ID' => $ID
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return new User($data);
    }

}