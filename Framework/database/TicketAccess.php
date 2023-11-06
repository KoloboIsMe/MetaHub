<?php

namespace database;

use PDO;
use PDOException;
use services\TicketInterface;

include_once "services/TicketInterface.php";


class TicketAccess implements TicketInterface
{
    /**
     * @var null
     */
    protected $dataAccess = null;

    /**
     * @param $dataAccess
     */
    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * @param $ticketID
     * @return bool
     */
    public function existsTicket($ticketID): bool
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM ticket where ticket_ID = :ticketID');
            $statement->execute(['ticketID' => $ticketID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return isset($data['ticket_ID']);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $ticketID
     * @param $userID
     * @return bool
     */
    public function isTicketOwner($ticketID, $userID): bool
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT author FROM ticket where ticket_ID = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            if (!isset($data['author']))
                return false;
            return $data['author'] == $userID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return int[]
     */
    public function getTicketsID(): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket ORDER BY ticket_ID DESC LIMIT 100');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['ticket_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return int[]
     */
    public function get5LastTicketsID(): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket ORDER BY ticket_ID DESC LIMIT 5');
            $statement->execute();
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['ticket_ID'];
            }
            return $ID;

        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $title
     * @param $message
     * @param $date
     * @param $author
     * @return int
     */
    public function createTicket($title, $message, $date, $author)
    {
        try {
            $statement = $this->dataAccess->prepare('INSERT INTO ticket (title, message, date, author) VALUES (:title, :message, :date, :author)');
            $statement->execute([
                ':title' => htmlspecialchars($title),
                ':message' => htmlspecialchars($message),
                ':date' => $date,
                ':author' => $author,
            ]);
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket Where title = :title and message = :message and date = :date and author = :author LIMIT 1');
            $statement->execute([
                ':title' => htmlspecialchars($title),
                ':message' => htmlspecialchars($message),
                ':date' => $date,
                ':author' => $author,
            ]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user['ticket_ID'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $id
     * @param $title
     * @param $message
     * @return void
     */
    public function editTicket($id, $title, $message): void
    {
        try {
            $statement = $this->dataAccess->prepare('UPDATE ticket SET title = :title, message = :message WHERE ticket_ID = :id');
            $statement->execute([
                ':id' => $id,
                ':title' => htmlspecialchars($title),
                ':message' => htmlspecialchars($message)
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}