<?php

namespace service;
class OutputData
{
    protected $outputDataTickets;
    protected $outputDataComments;
    protected $outputDataUsers;
    protected $outputDataCategories;

    public function __destruct()
    {
        $this->outputDataTickets = null;
        $this->outputDataComments = null;
    }

    //outputdata Tickets
    public function setOutputDataTickets($outputDataTickets)
    {
        $this->resetOutputDataTickets();
        $this->outputDataTickets[0] = $outputDataTickets;
    }
    public function getOutputDataTickets($id = 0)
    {
        return $this->outputDataTickets[$id];
    }
    public function addOutputDataTickets($Ticket, $id)
    {
        if(!isset($this->outputDataTickets[$id]))
            $this->outputDataTickets[$id] = $Ticket;
    }
    public function resetOutputDataTickets()
    {
        $this->outputDataTickets = [];
    }

    //outputdata Comments
    public function getOutputDataComments($Ticketid = 0)
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

    //outputdata Uers
    public function setOutputDataUsers($outputDataUsers)
    {
        $this->resetOutputDataUsers();
        $this->outputDataUsers[0] = $outputDataUsers;
    }
    public function getOutputDataUsers($id = 0)
    {
        return $this->outputDataUsers[$id];
    }
    public function addOutputDataUsers($User, $id)
    {
        if(!isset($this->outputDataUsers[$id]))
            $this->outputDataUsers[$id] = $User;
    }
    public function resetOutputDataUsers()
    {
        $this->outputDataUsers = [];
    }

    //outputdata Categories
    public function setOutputDataCategories($outputDataCategories)
    {
        $this->resetOutputDataCategories();
        $this->outputDataCategories[0] = $outputDataCategories;
    }
    public function getOutputDataCategories($id = 0)
    {
        return $this->outputDataCategories[$id];
    }
    public function addOutputDataCategories($User, $id)
    {
        if(!isset($this->outputDataCategories[$id]))
            $this->outputDataCategories[$id] = $User;
    }
    public function resetOutputDataCategories()
    {
        $this->outputDataCategories = [];
    }



}