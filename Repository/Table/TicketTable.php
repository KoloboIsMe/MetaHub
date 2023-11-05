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
    const TABLE = TICKET_TABLE;
    private function newEntity(array $data) : Ticket
    {
        $ticket['id'] = $data['ticket_ID'];
        $ticket['title'] = $data['title'];
        $ticket['message'] = $data['message'];
        $ticket['date'] = $data['date'];
        $ticket['author'] = $data['author'];
        return new Ticket($ticket);
    }
    public function ticketsOf(User|int $author) : array|bool
    {
        $userId = is_int($author) ? $author : $author->getId();
        if(($record = $this->select($userId, 'author')) === FALSE)
        {
            return FALSE;
        }
        $tickets = array();
        foreach ($record->getData() as $ticket) {
            $tickets[] = $ticket->ticket();
        }
        return $tickets;
    }
}