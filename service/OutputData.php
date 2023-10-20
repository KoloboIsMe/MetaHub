<?php

namespace service;
class OutputData
{
    protected $outputDataTickets;
    protected $outputDataComments = [];
    protected $outputDataUsers = [];

    public function __destruct()
    {
        $this->outputDataTickets = null;
        $this->outputDataComments = null;
    }

    public function getOutputDataTickets()
    {
        return $this->outputDataTickets;
    }

    public function setOutputDataTickets($outputDataTickets): void
    {
        $this->outputDataTickets = $outputDataTickets;
    }

    public function getOutputDataComments($Ticketid)
    {
        return $this->outputDataComments[$Ticketid];
    }

    public function addOutputDataComments($Comment, $Ticketid)
    {
        $this->outputDataComments[$Ticketid] = $Comment;
    }

    public function resetOutputDataComments()
    {
        $this->outputDataComments = [];
    }

    public function getOutputDataUser($id)
    {
        return $this->outputDataUsers[$id];
    }

    public function addOutputDataUser($User, $id)
    {
        if(!isset($this->outputDataUsers[$id]))
            $this->outputDataUsers[$id] = $User;
    }

    public function resetOutputDataUsers()
    {
        $this->outputDataUsers = [];
    }


}