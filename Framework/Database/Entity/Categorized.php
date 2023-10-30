<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  CATEGORY  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a ticket's categorization.
/// A special entity wich does not own an ID.
/// Foreign keys : Ticket and Category

class Categorized extends Entity
{
    public function __construct(private int $ticket, private int $category)
    {
        parent::__construct([$this->ticket, $this->category]);
    }
    public function getTicket () : int
    {
        return $this->ticket;
    }
    public function setTicket (int $ticket) : Categorized
    {
        $this->ticket = $ticket;
        return $this;
    }
    public function setCategory (int $category) : Categorized
    {
        $this->category = $category;
        return $this;
    }
    public function getCategory () : int
    {
        return $this->category;
    }
}