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
    public function extracted(false|\PDOStatement $statement): array
    {
        $comments = [];
        $cpt = 0;
        while ($comment = $statement->fetch(PDO::FETCH_OBJ)) {
            $aComment = new Comment($comment -> comment_ID, $comment -> text, $comment -> date, $comment -> author, $comment -> ticket);
            $comments[$cpt] = $aComment;
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
            ':ticket' => $comment->getTicket()
        ]))){
            echo "erreur requete insertion (exception)";
            return null;
        }
    }
    public function updateComment($comment, $newText){
        $comment->setText($newText);

        $statement = $this->PDO->prepare("UPDATE comment SET text = :newText WHERE comment_ID = :ID");
        if(!($statement->execute([
            ':ID' => $comment->getCommentID(),
            ':newText' => $comment->getText()
        ]))){
            echo "erreur requete update(exception)";
        }
    }
    public function deleteComment($comment){
        $statement = $this->PDO->prepare("DELETE FROM comment WHERE comment_ID = :ID");
        if(!$statement->execute([
            ':ID' => $comment->getCommentID(),
        ])){
            echo "erreur requete delete(exception)";
            return null;
        }
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
        return $this->extracted($statement);
    }
    public function selectAllComment(){
        $statement = $this->PDO->prepare("SELECT * FROM comment");
        if(!$statement->execute()){
            echo "erreur requete (exception)";
            return null;
        }
        return $this->extracted($statement);
    }
}