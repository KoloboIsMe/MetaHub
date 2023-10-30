<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  COMMENT  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single comment.
/// TO DO : Give default values to constructor
/// Foreign keys : Author and Ticket

use Framework\Database\Entity\Identified;

class Comment extends Entity
{
    use Identified;
    public function __construct(int $ID, private string $text = 'null', private string $date = 'null', private int $author = 0, private $ticket = null)
    {
        parent::__construct([$ID]);
    }
    public function setText(string $text) : Comment
    {
        $this->text = $text;
        return $this;
    }
    public function setDate(string $date) : Comment
    {
        $this->date = $date;
        return $this;
    }
    public function setAuthor(int $author) : Comment
    {
        $this->author = $author;
        return $this;
    }
    public function setTicket(int $ticket) : Comment
    {
        $this->ticket = $ticket;
        return $this;
    }
    public function getText() : string
    {
        return $this->text;
    }
    public function getDate() : string
    {
        return $this->date;
    }
    public function getAuthor() : int
    {
        return $this->author;
    }
    public function getTicket() : int
    {
        return $this->ticket;
    }
}