<?php

namespace database;

use entities\Category;
use entities\Comment;
use entities\Post;
use entities\Ticket;
use entities\User;
use PDO;
use PDOException;
use service\TicketInterface;

include_once "service/TicketInterface.php";


class TicketAccess implements TicketInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function existsTicket($ticketID)
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

    public function getPostById($ticketId)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM ticket where ticket_ID = :ticketId');
            $statement->execute(['ticketId' => $ticketId]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            $ticket = new Ticket($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        try {
            $categories = [];
            $statement = $this->dataAccess->prepare('SELECT * FROM category where category_ID in (SELECT category FROM categorized where ticket = :ticketID) ORDER BY category_ID DESC LIMIT 100');
            $statement->execute(['ticketID' => $ticketId]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Category($data);
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        try {
            $comments = [];
            $statement = $this->dataAccess->prepare('SELECT comment_ID,text,date,author,ticket,username FROM comment 
                                                JOIN user ON comment.author = user.user_ID
                                                   where ticket = :ticketID LIMIT 100');
            $statement->execute(['ticketID' => $ticketId]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $comments[] = new Comment($data);
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        try {
            $statement = $this->dataAccess->prepare('SELECT * FROM user where user_ID = :user_ID');
            $statement->execute(['user_ID' => $ticket->getAuthor()]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            $user = new User($data);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        return new Post($ticket, $categories, $comments, $user);
    }

    public function getTicketsID()
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

    public function get5LastTicketsID()
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

    public function createTicket($title, $message, $date, $author)
    {
        try {
            $statement = $this->dataAccess->prepare('INSERT INTO ticket (title, message, date, author) VALUES (:title, :message, :date, :author)');
            $statement->execute([
                ':title' => $title,
                ':message' => $message,
                ':date' => $date,
                ':author' => $author,
            ]);
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket Where title = :title and message = :message and date = :date and author = :author LIMIT 1');
            $statement->execute([
                ':title' => $title,
                ':message' => $message,
                ':date' => $date,
                ':author' => $author,
            ]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user['ticket_ID'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function addCategoryToTicket($category, $ticketID)
    {
        try {
            $statement = $this->dataAccess->prepare('INSERT INTO categorized (category, ticket) VALUES (:category, :ticket)');
            $statement->execute([
                ':category' => $category,
                ':ticket' => $ticketID,
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getCategoryIdByLabel($label)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT category_ID FROM category where label = :label');
            $statement->execute([
                ':label' => $label,
            ]);
            return $statement->fetch(PDO::FETCH_ASSOC)['category_ID'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicket($ticketID)
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM comment WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);

            $statement = $this->dataAccess->prepare('DELETE FROM categorized WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);

            $statement = $this->dataAccess->prepare('DELETE FROM ticket WHERE ticket_ID = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);

        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function editTicket($id, $title, $message)
    {
        try {
            $statement = $this->dataAccess->prepare('UPDATE ticket SET title = :title, message = :message WHERE ticket_ID = :id');
            $statement->execute([
                ':id' => $id,
                ':title' => $title,
                ':message' => $message
            ]);

        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function isTicketOwner($ticketID, $userID)
    {
        try {
            $statement = $this->dataAccess->prepare('SELECT author FROM ticket where ticket_ID = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            if(!isset($data['author']))
                return false;
            return $data['author'] == $userID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


}