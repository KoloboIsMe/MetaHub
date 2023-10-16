<?php
namespace Framework\Database;

use Framework\Entity\Ticket;
use PDO;
class TicketDatabase
{
    //déclarer des constantes pour les limites de tailles
    const ID_LENGTH = 10;
    const TITLE_LENGHT = 10;
    const MESSAGE_LENGTH = 280;
    const DATE_FORMAT =  'd/m/Y';

    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = dataBaseConnexion::getInstance()->getPDO();
    }

    public function extracted(false|\PDOStatement $statement): array
    {
        $tickets = [];
        $cpt = 0;
        while ($ticket = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new Ticket($ticket->ID, $ticket->title, $ticket->message, $ticket->date, $ticket->author);
            $tickets[$cpt] = $post;
            $cpt++;
        }
        return $tickets;
    }

    public function selectTicket($attribute, $data): ?array
    {
        $statement = $this->PDO->prepare("SELECT * FROM ticket WHERE $attribute = :data LIMIT 100");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
        $tickets = [];
        $cpt = 0;
        while ($ticket = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new Ticket($ticket->ticket_ID, $ticket->title, $ticket->message, $ticket->author,  $ticket->date);
            $tickets[$cpt] = $post;
            $cpt++;
        }
        return $tickets;
    }

    public function insert($ticket){
        $statement = $this->PDO->prepare(
            "INSERT INTO ticket (title, message, date, author) VALUES (:title, :message, :date, :author)");
        if(!($statement->execute([
            ':title' => $ticket->getTitle(),
            ':message' => $ticket->getMessage(),
            ':date' => $ticket->getDate(),
            ':author' => $ticket->getAuthor(),
        ]))){
            echo "erreur requete insertion(exception)";
            return null;
        }
    }


    public function verifTicket($ticket): bool
    {
        if (strlen($ticket->getID()) > self::ID_LENGTH ||
        strlen($ticket->getTitle()) > self::TITLE_LENGHT ||
        strlen($ticket->getMessage()) > self::MESSAGE_LENGTH ||
        $ticket->getDate()->format == self::DATE_FORMAT)
        //lire la liste data dans UserDataBase pour verif si l'auteur est dans la base
        {
            return false;
        }
        return true;
    }

    public function selectFiveLeast(): ?array
    {
        $statement = $this->PDO->prepare("SELECT * FROM (SELECT * FROM USER ORDER BY ID DESC) WHERE ROWNUM <= 5;");
        if(!$statement->execute()){
            echo "erreur requete (exception)";
            return null;
        }
        return $this->extracted($statement);
    }

    public function selectAllTicket(): ?array
    {
        $statement = $this->PDO->prepare("SELECT * FROM USER LIMIT 100");
        if(!($statement->execute([]))){
            echo "erreur requete (exception)";
            return null;
        }
        return $this->extracted($statement);
    }

}