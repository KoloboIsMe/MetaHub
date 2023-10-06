<?php

namespace Database;

class CommentDatabase
{
    private $PDO;

    public function __construct()
    {
        $this->PDO = (new dataBaseConnexion())->getPDO();
    }

    public function insert($comment)
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO comment (comment_ID, text, date, author, ticket) VALUES (:comment_ID, :text, :date, :author, :ticket)");
        if(!($statement->execute([
            ':comment_ID' => $comment->getCommentID(),
            ':text' => $comment->getText(),
            ':date' => $comment->getDate(),
            ':author' => $comment->getAuthor(),
            ':ticket' => $comment->getTicket(),
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
    }

}