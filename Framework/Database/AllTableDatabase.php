<?php

namespace Database;
use Entity\User;
abstract class AllTableDatabase
{
    private $tableName;
    private $dbLink;
    public function __construct($tableName)
    {
        $this->dbLink = (new dataBaseConnexion)->connect();
        $this->tableName = $tableName;
    }
    function select($attribute, $data)
    {
        $request = "SELECT * FROM $this->tableName WHERE $attribute = '$data'";

        if (!($result = mysqli_query($this->dbLink, $request))) {
            echo 'Erreur dans requête<br >';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($this->dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $request . '<br>';
            exit();
        }
        return $result;
    }

    function add($data)
    {
        $request = "INSERT INTO $this->tableName (";
        $cpt = 0;
        foreach ($data as $key => $value) {
            if ($cpt != 0) {
                $request .= ", ";
            }
            $request .= $key;
            $cpt++;
        }
        $request .= ") VALUES (";
        $cpt = 0;
        foreach ($data as $key => $value) {
            if ($cpt != 0) {
                $request .= ", ";
            }
            $request .= "'$value'";
            $cpt++;
        }
        $request .= ")";
        if (!($result = mysqli_query($this->dbLink, $request))) {
            echo 'Erreur dans requête<br >';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($this->dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $request . '<br>';
            exit();
        }
    }

}