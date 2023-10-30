<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  TICKET  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single ticket.
/// TO DO : Create a constructor as in the Comment class

use Framework\Database\Entity\Identified;

class Ticket extends Entity
{
    use Identified;
    private $title;
    private $message;
    private $date;
    private $author;

    public function setTitle($title){
        if(is_string($title)){
            $this->title = $title;
        }
    }
    public function setMessage($message){
        if(is_string($message)){
            $this->message = $message;
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
    public function getTitle(){
        return $this->title;
    }
    public function getMessage(){
        return $this->message;
    }
    public function getDate(){
        return $this->date;
    }
    public function getAuthor(){
        return $this->author;
    }


}