<?php

namespace Framework\managers;

class TicketManager extends Manager
{
    public function getTickets()
    {
        return $this->getAll('tickets', 'Ticket');
    }

    public function getTicketsWithCondition(int $id)
    {
        return $this->getAllWithCondition('tickets', 'Ticket', 'ticket_id', $id);
    }
}