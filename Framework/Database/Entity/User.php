<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  User  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single user.
/// TO DO : Give default values to constructor.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Entity;
class User extends Entity
{
    use ID;
    private string $password;
    private string $username;
    private string $first_connexion;
    private string $last_connexion;
    static function register(string $username, string $password) : User
    {
        return new User(array(
            'password' => $password,
            'username' => $username,
            'first_connexion' => date('Y-m-d H:i:s'),
        ));
    }
    static function user(int $ID, string $password, string $username, string $first_connexion, string $last_connexion) : User
    {
        return new User(array(
            'ID' => $ID,
            'password' => $password,
            'username' => $username,
            'first_connexion' => $first_connexion,
            'last_connexion' => $last_connexion
        ));
    }
    public function setPassword(string $password) : User
    {
        $this->password = $password;
        return $this;
    }
    public function setUsername(string $username) : User
    {
        $this->username = $username;
        return $this;
    }
    public function setFirst_connexion(string $first_connexion) : User
    {
        $this->first_connexion = $first_connexion;
        return $this;
    }
    public function setLast_connexion(string $last_connexion) : User
    {
        $this->last_connexion = $last_connexion;
        return $this;
    }
    public function getPassword() : string
    {
        return $this->password;
    }
    public function getUsername() : string
    {
        return $this->username;
    }
    public function getFirst_connexion() : string
    {
        return $this->first_connexion;
    }
    public function getLast_connexion() : string
    {
        return $this->last_connexion;
    }
}