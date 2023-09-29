<?php

class TicketDatabase implements Database
{
    //déclarer des constantes pour les limites de tailles
    private $data;

    public function getData(){
        return $this->data;
    }

    public function insertTicket($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();

        //verifier si les valeurs sont conforme
        //faire des if pour verif les tailles et mettre l'exception dedans
        // //

        $query = "INSERT INTO TICKET ($ticketID, $ticketTitle, $ticketMessage, $ticketDate, $ticketAuthor, $ticketCategory) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
    }
}