<?php

namespace service;

class TicketsGetting
{

    private $outputData;
    private $tickets;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getTickets($dataccess)
    {
        $this->tickets = $dataccess->getTickets();
        $this->outputData->setOutputData($this->tickets);
    }
}