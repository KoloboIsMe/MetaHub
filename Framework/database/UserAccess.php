<?php

namespace database;

use entities\User;
use PDO;
use PDOException;
use service\UserInterface;

include_once "service/UserInterface.php";

class UserAccess implements UserInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function existsUser($user_ID)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM user where user_ID = :user_ID');
            $statement->execute(['user_ID' => $user_ID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return isset($data['user_ID']);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getUserByUsername($username)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM user where username = :username');
            $statement->execute([':username' => $username]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return new User($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getUsersUsername()
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT username FROM user ORDER BY username DESC LIMIT 100');
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            $users = [];
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $data['username'];
            }
            return $users;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function isUser($username, $password)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT password FROM user where username = :username LIMIT 100');
            $statement->execute([':username' => $username]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if (isset($user['password']) && password_verify($password, $user['password']))
                return true;
            else
                return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function register($username, $password, $date)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT username FROM user where username = :username LIMIT 100');
            $statement->execute([':username' => $username]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (isset($user['username']))
                return 'nom d\'utilisateur déjà utilisé';
            else {
                $statement = $this->dataAccess->prepare('INSERT INTO user (username, password, first_connexion) VALUES (:username, :password, :date)');
                $statement->execute([
                    ':username' => $username,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':date' => $date,
                ]);
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function updateLastConnexion($user_ID)
    {
        try {
            $statement = $this->dataAccess->prepare('UPDATE user SET last_connexion = :date WHERE user_ID = :user_ID');
            $statement->execute([
                ':date' => date("Y-m-d H:i:s"),
                ':user_ID' => $user_ID,
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getUserById($id)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM user where user_ID = :id');
            $statement->execute([':id' => $id]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return new User($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getUsersID()
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT user_ID FROM user ORDER BY user_ID DESC LIMIT 100');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['user_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPostsIdByUserId($userId)
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket where author = :userId ORDER BY ticket_ID DESC LIMIT 100');
            $statement->execute([':userId' => $userId]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['ticket_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


}