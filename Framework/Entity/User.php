<?php

namespace Framework\entities;

include_once 'entities/Entity.php';
class User extends Entity
{
    private $user_ID;
    private $password;
    private $username;
    private $first_connexion;
    private $last_connexion;
    private $admin;

    //Setters
    public function setUser_ID($user_ID){
        $user_ID = (int) $user_ID;
        if($user_ID > 0){
            $this->user_ID = $user_ID;
        }
    }
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

    //Getters
    public function getUser_ID(){
        return $this->user_ID;
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