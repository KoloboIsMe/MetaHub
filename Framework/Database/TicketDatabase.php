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
        //faire des if pour verif les tailles et mettre l'exception dedans
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();

        if(strlen($ticketID) == self::$ID_LENGTH){
            //le ticket peut se créer
        }
        else
            //le ticket ne peut pas se créer

        if(strlen($ticketTitle) == self::$TITLE_LENGHT){
            //le ticket peut se créer
        }
        else
            //le ticket ne peut pas se créer

        if(strlen($ticketMessage) == self::$MESSAGE_LENGTH){
            //le ticket peut se créer
        }
        else
            //le ticket ne peut pas se créer

        if($ticketDate->format == self::$DATE_FORMAT){
            //le ticket peut se créer
        }
        else
            //le ticket ne peut pas se créer

        $userIdRequest = "SELECT ID FROM USER";
        if ($userIdRequest->num_rows != 0){
            //le ticket peut se créer
        }
        else
            //le ticket ne peut pas se créer

        $categoryIdRequest = "SELECT ID FROM CATEGORY";
        if($categoryIdRequest->num_rows != 0){
            //le ticket peut se créer
        }
//        else
//            //le ticket ne peut pas se créer
    }

    public function insertTicket($ticket){
        $ticketID = $ticket->getID();
        $ticketTitle = $ticket->getTitle();
        $ticketMessage = $ticket->getMessage();
        $ticketDate = $ticket->getDate();
        $ticketAuthor = $ticket->getAuthor();
        $ticketCategory = $ticket->getCategory();


        //verifier si les valeurs sont conforme
        verifTicket($ticket);


        $query = "INSERT INTO TICKET ($ticketID, $ticketTitle, $ticketMessage, $ticketDate, $ticketAuthor, $ticketCategory) VALUES $ticket ";
        $id = "SELECT ID FROM TICKET";
        $ticket->setId($id);
    }
}