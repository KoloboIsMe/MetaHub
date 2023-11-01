<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  CATEGORY  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a ticket's categorization (Association).
/// A special entity which does not own an ID.
/// Foreign keys : Ticket and Category
/// Foreign keys are ALSO Primary keys.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Entity;
class Categorized extends Entity
{
    private int $ticket;
    private int $category;
    public function __construct(int $ticket, int $category)
    {
        parent::__construct([$ticket, $category]);
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