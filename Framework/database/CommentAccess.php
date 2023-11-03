<?php

namespace database;

use service\CommentInterface;

include_once "service/CommentInterface.php";
include_once "Framework/entities/Comment.php";

class CommentAccess implements CommentInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess){
        $this->dataAccess = $dataAccess;
    }

}