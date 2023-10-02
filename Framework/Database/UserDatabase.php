<?php

namespace Database;

use Entity\User;
use PDO;

require_once('DataBaseConnexion.php');
require_once('Framework/Entity/User.php');

class UserDatabase
{
    private $PDO;
    public function __construct()
    {
        $this->PDO = (new dataBaseConnexion())->getPDO();
    }
    public function selectUser($attribute, $data)
    {
        $statement = $this->PDO->prepare("SELECT * FROM user WHERE $attribute = :data");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
        $users = [];
        $cpt = 0;
        while ($user = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new User($user->ID, $user->PASSWORD, $user->IMG_ID, $user->USERNAME, $user->FIRST_CONNEXION, $user->LAST_CONNEXION);
            $users[$cpt] = $post;
            $cpt++;
        }
        return $users;
    }

    public function insert($user)
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO user (ID, PASSWORD, IMG_ID, USERNAME, FIRST_CONNEXION, LAST_CONNEXION) VALUES (:ID, :PASSWORD, :IMG_ID, :USERNAME, :FIRST_CONNEXION, :LAST_CONNEXION)");
        if(!($statement->execute([
            ':ID' => $user->getID(),
            ':PASSWORD' => $user->getPassword(),
            ':IMG_ID' => $user->getImg(),
            ':USERNAME' => $user->getUsername(),
            ':FIRST_CONNEXION' => $user->getFirstConnexion(),
            ':LAST_CONNEXION' => $user->getLastConnexion()
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
    }

    public function selectByUsername($username)
    {
        return $this->selectUser('USERNAME', $username);
    }

    public function selectByFirstConnexion($firstConnexion)
    {
        return $this->selectUser('FIRST_CONNEXION', $firstConnexion);
    }
}