<?php

namespace Database;
class CategoryDatabase
{
    private $PDO;

    public function __construct()
    {
        $this->PDO = (new dataBaseConnexion())->getPDO();
    }

    public function insert($category)
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO category (ID, label, description) VALUES (:ID, :label, :description)");
        if(!($statement->execute([
            ':ID' => $category->getID(),
            ':label' => $category->getLabel(),
            ':description' => $category->getDescription()
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
    }

    public function select($username = null) : GReturn{
        $request = "SELECT * FROM " . $this->dbName;
        if(empty($username) === false){
            $request .= " WHERE username = '" . $username . "'";
        }
        $result = $this->conn->query($request);
        $row = [];
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return new GReturn("ok", content: $row);
    }
}