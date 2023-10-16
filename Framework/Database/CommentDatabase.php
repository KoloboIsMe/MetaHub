<?php
namespace Framework\Database;

use Framework\Entity\Comment;
use PDO;
class CommentDatabase
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = dataBaseConnexion::getInstance()->getPDO();
    }
    public function selectComment($attribute, $data): ?array
    {
        $statement = $this->PDO->prepare("SELECT * FROM comment WHERE $attribute = :data LIMIT 100");
        if(!($statement->execute([
            'data' => $data
        ]))){
            echo "erreur requete (exception)";
            return null;
        }
        $comments = [];
        $cpt = 0;
        while ($comment = $statement->fetch(PDO::FETCH_OBJ)) {
            $post = new Comment($comment->comment_ID, $comment->text, $comment->date, $comment->author, $comment->ticket);
            $comments[$cpt] = $post;
            $cpt++;
        }
        return $comments;
    }

    public function insert($comment)
    {
        $statement = $this->PDO->prepare(
            "INSERT INTO comment (text, date, author, ticket) VALUES (:text, :date, :author, :ticket)");
        if(!($statement->execute([
            ':text' => $comment->getText(),
            ':date' => $comment->getDate(),
            ':author' => $comment->getAuthor(),
            ':ticket' => $comment->getTicket(),
        ]))){
            echo "erreur requete insertion (exception)";
            return null;
        }
    }

}