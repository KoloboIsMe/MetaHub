<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////  CATEGORY TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Category' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

use Category;

class CategoryTable
{
    use BasicTable;
    use IdentifiedTable;
    const TABLE = 'category';
    private function newEntity(array $data) : Category
    {
        $ID = $data[0];
        $label = $data[1];
        $description = $data[2];
        return new Category($ID, $label, $description);
    }
    public function getCategoriesWithTicket($TicketID) : array|null
    {
        $var = [];
        $request = 'SELECT * FROM categories where ID in (SELECT category FROM categorized where ticket = :ticketID) LIMIT 100';
        $statement = $this->connexion->prepare('SELECT * FROM categories where category_ID in (SELECT category FROM categorized where ticket = :ticketID) LIMIT 100');
        if(!$statement->execute([
            ':ticketID' => $TicketID
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new \Deprecated\CategoryTable($data);
        }
        return $var;
    }
}