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
    use IdentifiedTable;
    const TABLE = 'ticket';
    private function newEntity(array $data) : Ticket
    {
        $ticket['id'] = $data['ticket_ID'];
        $ticket['title'] = $data['title'];
        $ticket['message'] = $data['message'];
        $ticket['date'] = $data['date'];
        $ticket['author'] = $data['author'];
        return new Ticket($ticket);
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