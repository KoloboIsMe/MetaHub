<?php

namespace database;

use entities\Comment;
use PDO;
use service\CommentInterface;

include_once "service/CommentInterface.php";
include_once "entities/Comment.php";

class CommentAccess implements CommentInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

    public function getCommentsByTicketId($TicketId)
    {
        $var = [];
        $statement = $this->dataAccess->prepare('SELECT comment_ID,text,date,author,ticket,username FROM comments 
                                                JOIN users ON comments.author = users.user_ID
                                                   where ticket = :TicketId LIMIT 100');
        if(!$statement->execute([
            'TicketId' => $TicketId
        ])){
            echo "erreur requete (exception)";
            return null;
        }
        while($data = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Comment($data);
        }
        return $var;
    }
}