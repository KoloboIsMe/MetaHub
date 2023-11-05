<?php

namespace database;

use PDOException;
use services\CommentInterface;

include_once "services/CommentInterface.php";
include_once "Framework/entities/Comment.php";

class CommentAccess implements CommentInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function isCommentOwner($commentID, $user_ID): bool
    {
        try {
            $statement = $this->dataAccess->prepare("SELECT comment_ID FROM comment WHERE comment_ID = :commentID AND author = :user_ID");
            $statement->execute(array(
                ':commentID' => $commentID,
                ':user_ID' => $user_ID
            ));
            $data = $statement->fetch(\PDO::FETCH_ASSOC);
            return isset($data['comment_ID']);
        } catch (\PDOException $e) {
            throw new \PDOException("Error checking if comment owner");
        }
    }

    public function createComment($text, $date, $user_ID, $ticket_ID): void
    {

        try {
            $statement = $this->dataAccess->prepare("INSERT INTO comment (text, date, author, ticket) VALUES (:text, :date, :user_ID, :ticket_ID)");
            $statement->execute(array(
                ':text' => $text,
                ':date' => $date,
                ':user_ID' => $user_ID,
                ':ticket_ID' => $ticket_ID
            ));
        } catch (\PDOException $e) {
            throw new \PDOException("Error creating comment");
        }
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



}