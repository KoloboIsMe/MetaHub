<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  TICKET  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single ticket.
/// TO DO : Give default values to constructor.

use Framework\Database\Entity\Identified;

class Ticket extends Entity
{
    use Identified;
    private string $title;
    private string $message;
    private string $date;
    private int $author;
    public function __construct(int $ID, string $title, string $message, string $date, int $author)
    {
        parent::__construct([$ID, $title, $message, $date, $author]);
    }
    public function setTitle(string $title) : Ticket
    {
        $this->title = $title;
        return $this;
    }
    public function setMessage($message) : Ticket
    {
        $this->message = $message;
        return $this;
    }
    public function setDate($date) : Ticket
    {
        $this->date = $date;
        return $this;
    }
    public function setAuthor($author) : Ticket
    {
        $this->author = $author;
        return $this;
    }
    public function getTitle() : string
    {
        return $this->title;
    }
    public function getMessage() : string
    {
        return $this->message;
    }
    public function getDate() : string
    {
        return $this->date;
    }
    public function getAuthor() : int
    {
        return $this->author;
    }
}