<?php

namespace Deprecated;

use Framework\entities\Ticket;
use PDO;
use TicketInterface;

include_once "Model/TicketInterface.php";
include_once "entities/Ticket.php";


class TicketTable implements TicketInterface
{
    public function __construct(private $dataAccess)
    {

    }

    public function getTickets()
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM tickets LIMIT 100');
        if(!$statement->execute()){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Ticket($data);
        }
        return $var;
    }

    public function getTicketById($id)
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT * FROM tickets where ticket_ID = :id LIMIT 100');
        if(!$statement->execute([
            'id' => $id
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