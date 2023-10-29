<?php

namespace Framework\database;

use CategoryInterface;
use Framework\entities\Category;
use PDO;

include_once "Model/CategoryInterface.php";
include_once "entities/Category.php";

class CategoryDatabase implements CategoryInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getCategories()
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM categories LIMIT 100');
        if(!$statement->execute()){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new CategoryDatabase($data);
        }
        return $var;
    }

    public function getCategoryById($ID)
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM categories where category_ID = :ID LIMIT 100');
        if(!$statement->execute([
            'ID' => $ID
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new CategoryDatabase($data);
        }
        return $var;
    }

    public function getCategoriesWithTicket($TicketID)
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM categories where category_ID in (SELECT category FROM categorized where ticket = :ticketID) LIMIT 100');
        if(!$statement->execute([
            ':ticketID' => $TicketID
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new CategoryDatabase($data);
        }
        return $var;
    }


}