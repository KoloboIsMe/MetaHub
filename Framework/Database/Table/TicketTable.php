<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  TICKET TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Ticket' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

class TicketTable extends Database
{
    use IdentifiedTable;
    const TABLE = 'Ticket';
    private function newEntity(array $data) : \Category
    {
        $ID = $data[0];
        $title = $data[1];
        $message = $data[2];
        $date = $data[3];
        $author = $data[4];
        return new Category($ID, $title, $message, $date, $author);
    }
    public function getTicketsWithCategory($CategoryID)
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM tickets where ticket_ID in (SELECT ticket FROM categorized where category = :CategoryID) LIMIT 100');
        if(!$statement->execute([
            ':CategoryID' => $CategoryID
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Ticket($data);
        }
        return $var;
    }
}