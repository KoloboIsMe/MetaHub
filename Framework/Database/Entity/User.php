<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  User  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single user.
/// TO DO : Create a constructor as in the Comment class
use Framework\Database\Entity\Identified;

class User extends Entity
{
    use Identified;
    public function __construct(int $ID, private $password, private $username, private $first_connexion, private $last_connexion)
    {
        parent::__construct([$ID]);
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