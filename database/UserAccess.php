<?php

namespace database;

use entities\User;
use PDO;
use service\UserInterface;

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

    public function isUser($username, $password)
    {
        $statement = $this->dataAccess->prepare('SELECT password FROM users where username = :username LIMIT 100');
        if(!$statement->execute([
            ':username' => $username,
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if(isset($user['password']) && password_verify($password, $user['password']))
            return true;
        else
            return false;
    }

    public function register($username, $password, $date){
        $statement = $this->dataAccess->prepare('SELECT username FROM users where username = :username LIMIT 100');
        if(!$statement->execute([
            ':username' => $username,
        ])){
            echo "erreur requete (exception)";
        }
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if(isset($user['username']))
            return 'nom d\'utilisateur déjà utilisé';
        else{
            $statement = $this->dataAccess->prepare('INSERT INTO users (username, password, first_connexion) VALUES (:username, :password, :date)');
            if(!$statement->execute([
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':date' => $date,

            ])){
                echo "erreur requete (exception)";
            }
            return null;
        }
    }
}