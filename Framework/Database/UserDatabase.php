<?php

namespace Database;

use Entity\User;

require_once('DataBaseConnexion.php');
require_once('Framework/Entity/User.php');

class UserDatabase
{
    private $data; // List of users
    private $dbLink;

    public function __construct()
    {
        $this->dbLink = (new dataBaseConnexion)->connect('projetwebphp');
    }

    public function testRequest() : User{
        $request = "SELECT * FROM USER Where USERNAME = 'myke'";

        $result = mysqli_query($this->dbLink, $request);
        echo $result->num_rows;
        $result = mysqli_fetch_assoc($result);
        var_dump($result);
        echo $result['ID'];
        return new User($result['ID'], $result['PASSWORD'], $result['USERNAME'], $result['IMG_ID'], $result['FIRST_CONNEXION'], $result['LAST_CONNEXION']);

    }

//    public function selectFromUser($username = null): void
//    {
//        $request = "SELECT * FROM USER ";
//        if (empty($username) === false) {
//            $request .= " WHERE username = '" . $username . "'";
//        }
//
//        if (!($result = mysqli_query($this->dbLink, $request))) {
//            echo 'Erreur dans requête<br >';
//            // Affiche le type d'erreur.
//            echo 'Erreur : ' . mysqli_error($this->dbLink) . '<br>';
//            // Affiche la requête envoyée.
//            echo 'Requête : ' . $request . '<br>';
//            exit();
//        }
//        $rows = [];
//        if ($result->num_rows > 0) {
//            $rows = $result->fetch_assoc();
//            for ($i = 0; $i < count($rows); $i++) {
//                $rows[$i] = new User($rows[$i]['id'], $rows[$i]['password'], $rows[$i]['username'], $rows[$i]['img_id'], $rows[$i]['first_connexion'], $rows[$i]['last_connexion']);
//            }
//        }
//        $this->data = $rows;
//    }

    public function getData()
    {
        return $this->data;
    }

    public function showData()
    {
        foreach ($this->data as $user) {
            $user->showData();
        }
    }
}