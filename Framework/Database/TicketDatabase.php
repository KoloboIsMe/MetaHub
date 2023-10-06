<?php

use Database\dataBaseConnexion;

class TicketDatabase
{
    //déclarer des constantes pour les limites de tailles
    const ID_LENGTH = 10;
    const TITLE_LENGHT = 10;
    const MESSAGE_LENGTH = 280;
    const DATE_FORMAT =  'd/m/Y';

    private $PDO;

    public function __construct()
    {
        $this->PDO = (new dataBaseConnexion())->getPDO();
    }

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
        $statement = $this->PDO->prepare(
            "INSERT INTO user (ticket_ID, title, message, date, author) VALUES (null, :title, :message, :date, :author)");

        if(!($statement->execute([
            ':title' => $ticket->getTitle(),
            ':message' => $ticket->getMessage(),
            ':date' => $ticket->getDate(),
            ':author' => $ticket->getAuthor(),
        ]))){
            echo "erreur requete (exception)";
            return null;
        }

///        if($this->verifTicket($ticket) === false){generer une exception;}
    }
}