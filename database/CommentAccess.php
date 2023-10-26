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

}