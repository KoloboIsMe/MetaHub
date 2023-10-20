<?php

namespace service;

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
}