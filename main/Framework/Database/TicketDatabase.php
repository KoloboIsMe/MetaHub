<?php

class TicketDatabase
{
    //déclarer des constantes pour les limites de tailles
    const ID_LENGTH = 10;
    const TITLE_LENGHT = 10;
    const MESSAGE_LENGTH = 280;
    const DATE_FORMAT =  'd/m/Y';
    private $data;

    public function getData(){
        return $this->data;
    }
    public function verifTicket($ticket){
        if
        (strlen($ticket->getID()) > self::ID_LENGTH ||
        strlen($ticket->getTitle()) > self::TITLE_LENGHT ||
        strlen($ticket->getMessage()) > self::MESSAGE_LENGTH ||
        $ticket->getDate()->format == self::DATE_FORMAT)
        //lire la liste data dans UserDataBase pour verif si l'auteur est dans la base
        {
            return false;
        }
        return true;
    }

    public function insert($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();

        //verifier si les valeurs sont conforme
        if($this->verifTicket($ticket) === false){
            //generer une exception;
        }

        $query = "INSERT INTO TICKET ($ticketID, $ticketTitle, $ticketMessage, $ticketDate, $ticketAuthor, $ticketCategory) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
    }

    public function TESTinsert($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();

        //verifier si les valeurs sont conforme
        if($this->verifTicket($ticket) == false){
            echo '<br>Nous ne pouvons pas inserer le ticket dans la base<br>';
        }
        else{
            echo '<br>Ticket, inseré dans la base<br>';
        }
    }
}