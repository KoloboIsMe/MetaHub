<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////  COMMENT  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single comment.
/// TO DO : Give default values to constructor

namespace Framework\entities;

include_once 'entities/Entity.php';

class Comment extends Entity
{
    public function __construct(private $ID, private $text = null, private $date = null, private $author = null, private $ticket = null) {
        super([$this->ID, $this->text, $this->date, $this->author, $this->ticket]);
    }

    //Setters
    public function set_ID($ID){
        $ID = (int) $ID;
        if($ID > 0){
            $this->ID = $ID;
        }
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
    //Getters
    public function get_ID()
    {
        return $this->ID;
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