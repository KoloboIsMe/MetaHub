<?php

namespace database;

use entities\User;
use PDO;
use PDOException;
use service\UserInterface;

include_once "service/UserInterface.php";
include_once "entities/User.php";

class UserAccess implements UserInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getUserByUsername($username)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM users where username = :username');
            $statement->execute([':username' => $username ]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return new User($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getUsersUsername()
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT username FROM users ORDER BY username DESC LIMIT 100');
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            $users = [];
            while($data = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $users[] = $data['username'];
            }
            return $users;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
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