<?php

namespace Entity;

class Comment
{
    private $comment_ID;
    private $text;
    private $date;
    private $author;
    private $ticket;

    public function __construct($comment_ID, $text, $author, $ticket)
    {
        $this->comment_ID = $comment_ID;
        $this->text = $text;
        $this->date = date('d/m/Y');
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

    public function getDate(): string
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