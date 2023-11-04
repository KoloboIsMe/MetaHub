<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  COMMENT  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single comment.
/// TO DO : Give default values to constructor
/// Foreign keys : Author and Ticket
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Entity;

class Comment extends Entity
{
    use ID;
    private string $text;
    private string $date;
    private int $author;
    private int $ticket;
    public function __construct(int $ID, string $text = 'null', string $date = 'null', int $author = 0, int $ticket = 0)
    {
        parent::__construct([$ID, $text, $date, $author, $ticket]);
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