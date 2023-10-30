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
    private $password;
    private $username;
    private $first_connexion;
    private $last_connexion;
    private $admin;

    public function setPassword($password){
        if(is_string($password)){
            $this->password = $password;
        }
    }
    public function setUsername($username){
        if(is_string($username)){
            $this->username = $username;
        }
    }
    public function setFirst_connexion($first_connexion){
        $this->first_connexion = $first_connexion;
    }
    public function setLast_connexion($last_connexion){
        $this->last_connexion = $last_connexion;
    }
    public function setAdmin($admin){
        $admin = (int) $admin;
        if($admin === 0 || $admin === 1){
            $this->admin = $admin;
        }
    }
    public function getPassword(){
        return $this->password;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getFirst_connexion(){
        return $this->first_connexion;
    }
    public function getLast_connexion(){
        return $this->last_connexion;
    }
    public function getAdmin(){
        return $this->admin;
    }
}