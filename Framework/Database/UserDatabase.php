<?php

class UserDatabase implements Database
{
    private $data; // List of users
    private $dbLink;

    public function __construct($dbHost, $dbLogin, $dbPass, $dbTableName) {
        $this->dbLink = mysqli_connect($dbHost, $dbLogin, $dbTableName)
            or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($this->dbLink , $dbTableName)
            or die('Erreur dans la sélection de la base : ' . mysqli_error($this->dbLink));
    }
    public function select($username = null) {
        $request = "SELECT * FROM " . $this->dbName;
        if(empty($username) === false){
            $request .= " WHERE username = '" . $username . "'";
        }
        $result = mysqli_query($this->dbLink, $request);

        $row = [];
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        $this->data = $row;
    }

    public function getData(){
        return $this->data;
    }
}