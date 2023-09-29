<?php

class TicketDatabase implements Database
{
    private $data;

    public function getData(){
        return $this->data;
    }

    public function insertTicket($ticket){
        //recupérer les valeurs
        //verifier si les valeurs sont conforme

        $query = "INSERT INTO TICKET ($title, $author) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
        //tout mettre dans le field
    }
}