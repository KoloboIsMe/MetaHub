<?php

namespace Deprecated;

use Framework\database\Record;
use Framework\Database\Table\Connexion;
use PDO;

class CategoryTable
{
    public function __construct(private readonly Connexion $connexion)
    {

    }
    public function getCategories() : array|null
    {
        $categories = new Record();
        $query = $this->connexion->prepare('SELECT * FROM categories LIMIT 100');
        if(!$query->execute())
        {
            echo "erreur requete (exception)";
            return null;
        }
        while($datum = $query->fetch(PDO::FETCH_ASSOC))
        {
            $category = new \Category($datum);
            $categories->addDatum($category);
        }
        return $categories;
    }
    public function getCategoryById($ID) : array|null
    {
        $var = [];
        $statement = $this->connexion->prepare('SELECT * FROM categories where category_ID = :ID LIMIT 100');
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
    public function getCategoriesWithTicket($TicketID) : array|null
    {
        $var = [];
        $statement = $this->connexion->prepare('SELECT * FROM categories where category_ID in (SELECT category FROM categorized where ticket = :ticketID) LIMIT 100');
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