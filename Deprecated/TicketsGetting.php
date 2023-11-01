<?php

namespace Deprecated;

class TicketsGetting
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getTickets($dataccess)
    {
        $tickets = $dataccess->getTickets();
        $this->outputData->setOutputDataTickets($tickets);
    }

    public function getTicketById($dataccess, $id)
    {
        $tickets = $dataccess->getTicketById($id);
        $this->outputData->setOutputDataTickets($tickets);
    }

    public function addTicketsWithCategory($dataccess, $CategoryID)
    {
        $tickets = $dataccess->getTicketsWithCategory($CategoryID);
        $this->outputData->addOutputDataTickets($tickets, $CategoryID);
    }
    public function resetOutputDataTickets()
    {
        $this->outputData->resetOutputDataTickets();
    }
}