<?php

namespace Framework\Entity;

class Comment
{
    private $comment_ID;
    private $text;
    private $date;
    private $author;
    private $ticket;

    public function __construct($comment_ID, $text, $date, $author, $ticket)
    {
        $this->comment_ID = $comment_ID;
        $this->text = $text;
        $this->date = $date;
        $this->author = $author;
        $this->ticket = $ticket;
    }

    /**
     * @return mixed
     */
    public function getCommentID()
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

    /**
     * @param mixed $comment_ID
     */
    public function setCommentID($comment_ID): void
    {
        $this->comment_ID = $comment_ID;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @param mixed $ticket
     */
    public function setTicket($ticket): void
    {
        $this->ticket = $ticket;
    }


}