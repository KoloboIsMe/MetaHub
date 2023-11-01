<?php

namespace Deprecated;

class CommentsGetting
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function addCommentsByTicketId($dataccess, $TicketId)
    {
        $comments = $dataccess->getCommentsByTicketId($TicketId);
        $this->outputData->addOutputDataComments($comments, $TicketId);
    }

    public function resetOutputDataComments()
    {
        $this->outputData->resetOutputDataComments();
    }

}