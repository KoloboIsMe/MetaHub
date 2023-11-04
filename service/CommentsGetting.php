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
        $commentAccess->createComment($text, date("Y-m-d H:i:s"), $_SESSION['user_ID'], $ticketID);
    }

}