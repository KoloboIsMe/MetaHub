<?php

namespace database;

use PDO;
use PDOException;

class GeneralAccess
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function deleteTicketComments($ticketID)
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM comment WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteComment($commentID)
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM comment WHERE comment_ID = :commentID');
            $statement->execute([':commentID' => $commentID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicketCategorized($ticketID)
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM categorized WHERE ticket = :ticketID');
            $statement->execute([':ticketID' => $ticketID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteTicket($ticketID)
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

    public function deleteUser($id){
        try {
            $statement = $this->dataAccess->prepare("DELETE FROM user WHERE user_ID = :id");
            $statement->execute(array(':id' => $id));
        } catch (\PDOException $e) {
            throw new \PDOException("Error deleting user");
        }
    }

    public function deleteCategoryCategorized($category_ID)
    {
        try {
            $statement = $this->dataAccess->prepare('DELETE FROM categorized WHERE category = :category_ID');
            $statement->execute([':category_ID' => $category_ID]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function deleteCategory($id){
        try {
            $this->deleteCategoryCategorized($id);
            $statement = $this->dataAccess->prepare("DELETE FROM category WHERE category_ID = :id");
            $statement->execute(array(':id' => $id));
        } catch (\PDOException $e) {
            throw new \PDOException("Error deleting category");
        }
    }

    public function getTicketsIdByUserId($userId)
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

    public function getCommentsIdByUserId($userId)
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



}