<?php

namespace Database;

use Entity\User;
use PDO;
use function PHPUnit\Framework\throwException;

require_once('DataBaseConnexion.php');
require_once('Framework/Entity/User.php');

class UserDatabase
{
    //database connection
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
            "INSERT INTO user (ID, PASSWORD, IMG_ID, USERNAME, FIRST_CONNEXION, LAST_CONNEXION) VALUES (null, :PASSWORD, :IMG_ID, :USERNAME, :FIRST_CONNEXION, :LAST_CONNEXION)");
        if(!($statement->execute([
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

    public function selectFromUsername($username)
    {
        return $this->selectUser('USERNAME', $username);
    }

    public function selectFromFirstConnexion($firstConnexion)
    {
        return $this->selectUser('FIRST_CONNEXION', $firstConnexion);
    }
}