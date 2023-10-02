<?php

class TicketDatabase implements Database
{
    //déclarer des constantes pour les limites de tailles
    private $ID_LENGTH = 10;
    private $TITLE_LENGHT = 10;
    private $MESSAGE_LENGTH = 280;
    private $DATE_FORMAT =  'd/m/Y';
    private $data;

    public function getData(){
        return $this->data;
    }
    public function verifTicket($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $userIdRequest = "SELECT ID FROM USER";
        $categoryIdRequest = "SELECT ID FROM CATEGORY";

        if
        (strlen($ticketID) != self::$ID_LENGTH ||
        strlen($ticketTitle) != self::$TITLE_LENGHT ||
        strlen($ticketMessage) != self::$MESSAGE_LENGTH ||
        $ticketDate->format == self::$DATE_FORMAT ||
        $userIdRequest->num_rows <= 0 ||
        $categoryIdRequest->num_rows <= 0)
        {
            return false;
        }
    }

    public function insert($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();

        //verifier si les valeurs sont conforme
        if(verifTicket($ticket) == false){
            //generer une exception;
        }

        $query = "INSERT INTO TICKET ($ticketID, $ticketTitle, $ticketMessage, $ticketDate, $ticketAuthor, $ticketCategory) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
    }
}