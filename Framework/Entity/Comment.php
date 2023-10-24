<?php

namespace Framework\entities;

include_once 'entities/Entity.php';

class Comment extends Entity
{
    private $comment_ID;
    private $text;
    private $date;
    private $author;
    private $ticket;

    //Setters
    public function setComment_ID($comment_ID){
        $comment_ID = (int) $comment_ID;
        if($comment_ID > 0){
            $this->comment_ID = $comment_ID;
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
    /**
     * @return mixed
     */
    public function getComment_ID()
    {
        return $this->comment_ID;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }


}