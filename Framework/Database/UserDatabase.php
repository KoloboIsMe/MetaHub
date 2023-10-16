<?php
namespace Framework\Database;

use Framework\Entity\User;
use PDO;

class UserDatabase
{
    private static $instance = null;

    //database connection
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = dataBaseConnexion::getInstance()->getPDO();
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
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

    public function selectByUsername($username): ?array
    {
        return $this->selectUser('USERNAME', $username);
    }

    public function selectByFirstConnexion($firstConnexion): ?array
    {
        return $this->selectUser('FIRST_CONNEXION', $firstConnexion);
    }

    public function updateLastConnexion($user, $lastConnexion): void
    {
        $statement = $this->PDO->prepare(
            "UPDATE user SET last_connexion = :LAST_CONNEXION WHERE user_ID = :USER_ID");
        if(!($statement->execute([
            ':LAST_CONNEXION' => $lastConnexion,
            ':USER_ID' => $user->getUserID()
        ]))){
            echo "erreur requete update (exception)";
        }
    }
}