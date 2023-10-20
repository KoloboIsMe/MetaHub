<?php

namespace database;


use entities\Ticket;
use PDO;
use TicketInterface;

include_once "service/TicketInterface.php";
include_once "entities/Ticket.php";


class TicketAccess implements TicketInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
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

    public function getTicketsById($id)
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
}