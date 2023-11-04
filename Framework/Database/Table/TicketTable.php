<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  TICKET TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Ticket' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

use Framework\Database\Entity\Ticket;
use PDO;

class TicketTable
{
    use BasicTable;
    const TABLE = 'ticket';
    private function newEntity(array $data) : Ticket
    {
        $ID = $data['ticket_ID'];
        $title = $data['title'];
        $message = $data['message'];
        $date = $data['date'];
        $author = $data['author'];
        return new Ticket($ID, $title, $message, $date, $author);
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