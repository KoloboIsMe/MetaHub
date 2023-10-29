<?php

namespace Framework\Database\Table;

use CategoryInterface;
use PDO;

class CategoryTable implements CategoryInterface
{
    private $dataAccess;

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
            $var[] = new CategoryTable($data);
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
            $var[] = new CategoryTable($data);
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
            $var[] = new CategoryTable($data);
        }
        return $var;
    }


}