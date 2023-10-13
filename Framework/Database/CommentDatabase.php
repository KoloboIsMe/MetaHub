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

    public function removeComment($data){
        $statement = $this->PDO->prepare("DELETE FROM COMMENT WHERE ID = :data;");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
    }

    public function selectAllTicket(){
        $statement = $this->PDO->prepare("SELECT * FROM COMMENT;");
        if(!($statement->execute([]))){
            echo "erreur requete (exception)";
            return null;
        }
        $comments = [];
        $cpt = 0;
        while ($ticket = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new Comment($ticket->comment_ID, $ticket->title, $ticket->message, $ticket->date);
            $comments[$cpt] = $post;
            $cpt++;
        }
        return $comments;
    }
}