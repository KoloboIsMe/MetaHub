<?php
namespace Framework\Database;

use Framework\Entity\User;
use PDO;

class UserDatabase
{

    //database connection
    private $PDO;
    private $test = "test";
    public function getTest()
    {
        return $this->test;
    }

    public function __construct()
    {
        $this->PDO = dataBaseConnexion::getInstance()->getPDO();
    }
    public function selectUser($attribute, $data)
    {
        $statement = $this->PDO->prepare("SELECT * FROM user WHERE $attribute = :data LIMIT 100");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
        $users = [];
        $cpt = 0;
        while ($user = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new User($user->user_ID, $user->username, $user->password, $user->first_connexion, $user->last_connexion);
            $users[$cpt] = $post;
            $cpt++;
        }
        return $users;
    }

    public function insert($user): void
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO user (username, password ,first_connexion, last_connexion) VALUES (:USERNAME, :PASSWORD, :FIRST_CONNEXION, :LAST_CONNEXION)");
        if(!($statement->execute([
            ':USERNAME' => $user->getUsername(),
            ':PASSWORD' => $user->getPassword(),
            ':FIRST_CONNEXION' => $user->getFirstConnexion(),
            ':LAST_CONNEXION' => $user->getLastConnexion()
        ]))){
            echo "erreur requete insertion (exception)";

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