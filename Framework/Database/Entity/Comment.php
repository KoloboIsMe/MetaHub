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
    public function __construct(int $ID, private string $text = 'null',
        private string $date = 'null', private int $author = 0, private $ticket = null)
    {
        parent::__construct([$this->ID, $this->text, $this->date,
            $this->author, $this->ticket]);
    }

    public function setText($text){
        if(is_string($text)){
            $this->text = $text;
        }
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setAuthor($author){
        $author = (int) $author;
        if($author > 0){
            $this->author = $author;
        }
    }
    public function setTicket($ticket){
        $ticket = (int) $ticket;
        if($ticket > 0){
            $this->ticket = $ticket;
        }
    }
    public function getText()
    {
        return $this->text;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getTicket()
    {
        return $this->ticket;
    }


}