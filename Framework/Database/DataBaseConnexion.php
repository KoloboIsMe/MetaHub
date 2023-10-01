<?php


namespace Database;
class dataBaseConnexion
{
    private $dbHost = '127.0.0.1';
    private $dbLogin = 'root';
    private $password;

    public function connect()
    {
        $dbLink = mysqli_connect($this->dbHost, $this->dbLogin, $this->password)
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink, 'MetaHub')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($this->dbLink));
        return $dbLink;
    }
}