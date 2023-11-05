<?php

namespace service;

class CommentsGetting
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function createComment($commentAccess, $text, $ticketID)
    {
        $commentAccess->createComment($text, date("Y-m-d H:i"), $_SESSION['user_ID'], $ticketID);
    }

    public function isCommentOwner($commentAccess, $commentID, $user_ID)
    {
        return $commentAccess->isCommentOwner($commentID, $user_ID);
    }

}