<?php

namespace Deprecated;

use CommentInterface;
use Framework\entities\Comment;
use PDO;

class CommentTable implements CommentInterface
{
    public function __construct(private $dataAccess)
    {

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