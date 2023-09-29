<?php

class TicketDatabase implements Database
{
    private $data;

    public function getData(){
        return $this->data;
    }

    public function insertTicket($ticket){

        $query = "INSERT INTO TICKET ($message, $author) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
    }
}