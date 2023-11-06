<?php

namespace database;

use entities\User;
use PDO;
use PDOException;
use services\UserInterface;

include_once "services/UserInterface.php";

class UserAccess implements UserInterface
{
    /**
     * @var null
     */
    protected $dataAccess = null;

    /**
     * @param $dataAccess
     */
    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * @param $username
     * @return bool
     */
    public function existsUsername($username): bool
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT username FROM user where username = :username');
            $statement->execute(['username' => $username]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return isset($data['username']);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $user_ID
     * @return bool
     */
    public function existsUser($user_ID): bool
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

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function isUser($username, $password): bool
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

    /**
     * @param $username
     * @return User
     */
    public function getUserByUsername($username): User
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

    /**
     * @param $id
     * @return User
     */
    public function getUserById($id): User
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

    /**
     * @return int[]
     */
    public function getUsersID(): array
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

    /**
     * @param $username
     * @param $password
     * @param $date
     * @return string|null
     */
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
                    ':username' => htmlspecialchars($username),
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':date' => $date,
                ]);
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $user_ID
     * @return void
     */
    public function updateUser($username, $password, $user_ID): void
    {
        try {
            $statement = $this->dataAccess->prepare('UPDATE user SET username = :username, password = :password WHERE user_ID = :user_ID');
            $statement->execute([
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':user_ID' => $user_ID,
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $user_ID
     * @return void
     */
    public function updateLastConnexion($user_ID): void
    {
        try {
            $statement = $this->dataAccess->prepare('UPDATE user SET last_connexion = :date WHERE user_ID = :user_ID');
            $statement->execute([
                ':date' => date("Y-m-d H:i"),
                ':user_ID' => $user_ID,
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return int[]
     */
    public function get10LastConnectedUsersID(): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT user_ID FROM user WHERE online = 1 ORDER BY last_connexion DESC LIMIT 8');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['user_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $user_ID
     * @param $online
     * @return void
     */
    public function setOnline($user_ID, $online): void
        {
            try {
                $statement = $this->dataAccess->prepare('UPDATE user SET online = :online WHERE user_ID = :user_ID');
                $statement->execute([
                    ':online' => $online,
                    ':user_ID' => $user_ID
                ]);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
}