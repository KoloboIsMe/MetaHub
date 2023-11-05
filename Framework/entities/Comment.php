<?php

namespace entities;

include_once 'Entity.php';

class Comment extends Entity
{
    private $comment_ID;
    private $text;
    private $date;
    private $author;
    private $author_username;
    private $ticket;

    public function setUsername($author_username)
    {
        if (is_string($author_username)) {
            $this->author_username = $author_username;
        }
    }

    /**
     * @return mixed
     */
    public function getComment_ID()
    {
        return $this->comment_ID;
    }

    public function setComment_ID($comment_ID)
    {
        $comment_ID = (int)$comment_ID;
        if ($comment_ID > 0) {
            $this->comment_ID = $comment_ID;
        }
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        if (is_string($text)) {
            $this->text = $text;
        }
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $author = (int)$author;
        if ($author > 0) {
            $this->author = $author;
        }
    }

    /**
     * @return mixed
     */
    public function getAuthor_username()
    {
        return $this->author_username;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket($ticket)
    {
        $ticket = (int)$ticket;
        if ($ticket > 0) {
            $this->ticket = $ticket;
        }
    }


}