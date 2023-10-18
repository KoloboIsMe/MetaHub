<?php

class TicketManager extends Model
{
    public function getTickets()
    {
        $this->getBdd();
        return $this->getAll('tickets', 'Ticket');
    }
}