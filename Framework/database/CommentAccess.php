<?php

namespace database;

use service\CommentInterface;

include_once "service/CommentInterface.php";
include_once "Framework/entities/Comment.php";

class CommentAccess implements CommentInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function createComment($text,$date, $user_ID, $ticket_ID){

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

}