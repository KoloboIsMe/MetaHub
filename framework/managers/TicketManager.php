<?php

namespace Framework\managers;


use Framework\entities\Ticket;
use TicketInterface;

class TicketManager implements TicketInterface
{
    protected $dataAccess = null;
    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getTickets()
    {
        $obj = 'Framework\entities\\'.$obj;
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

    public function getTicketsWithCondition($id)
    {

    }
}