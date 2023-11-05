<?php

namespace database;

use entities\Category;
use entities\Comment;
use entities\Post;
use entities\Ticket;
use entities\User;
use PDO;
use PDOException;

class GeneralAccess
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function deleteComment($commentID): void
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM comment WHERE comment_ID = :commentID');
            $statement->execute([':commentID' => $commentID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicket($ticketID): void
    {
        try {
            $this->deleteTicketComments($ticketID);
            $this->deleteTicketCategorized($ticketID);
            $statement = $this->dataAccess->prepare('DELETE FROM ticket WHERE ticket_ID = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicketComments($ticketID): void
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM comment WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicketCategorized($ticketID): void
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM categorized WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteUser($id): void
    {
        try {
            $statement = $this->dataAccess->prepare("DELETE FROM user WHERE user_ID = :id");
            $statement->execute(array(':id' => $id));
        } catch (\PDOException $e) {
            throw new \PDOException("Error deleting user");
        }
    }

    public function deleteCategory($id): void
    {
        try {
            $this->deleteCategoryCategorized($id);
            $statement = $this->dataAccess->prepare("DELETE FROM category WHERE category_ID = :id");
            $statement->execute(array(':id' => $id));
        } catch (\PDOException $e) {
            throw new \PDOException("Error deleting category");
        }
    }

    public function deleteCategoryCategorized($category_ID): void
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM categorized WHERE category = :category_ID');
            $statement->execute([':category_ID' => $category_ID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getTicketsIdByUserId($userId): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket_ID FROM ticket where author = :userId');
            $statement->execute([':userId' => $userId]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['ticket_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getCommentsIdByUserId($userId): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT comment_ID FROM comment where author = :userId');
            $statement->execute([':userId' => $userId]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['comment_ID'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPostsIdByCategoryId($id): array
    {
        try {
            $ID = [];
            $statement = $this->dataAccess->prepare('SELECT ticket FROM categorized where category = :ID ORDER BY ticket DESC LIMIT 100');
            $statement->execute([':ID' => $id]);
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $ID[] = $data['ticket'];
            }
            return $ID;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function addCategoryToTicket($category, $ticketID): void
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

    public function getPostById($ticketId): Post
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



}