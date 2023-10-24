<?php

namespace Framework\database;

use CommentInterface;
use Framework\entities\Comment;
use PDO;

include_once "Model/CommentInterface.php";
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
        $statement = $this->dataAccess->prepare('SELECT * FROM comments where ticket = :TicketId LIMIT 100');
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