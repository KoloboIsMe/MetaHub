<?php

namespace entities;

include_once 'Entity.php';

class Comment extends Entity
{
    /**
     * @var
     */
    private $comment_ID;
    /**
     * @var
     */
    private $text;
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $author;
    /**
     * @var
     */
    private $author_username;
    /**
     * @var
     */
    private $ticket;

    /**
     * @param $author_username
     * @return void
     */
    public function setUsername($author_username)
    {
        if (is_string($author_username)) {
            $this->author_username = $author_username;
        }
    }

    /**
     * @return int
     */
    public function getComment_ID()
    {
        return $this->comment_ID;
    }

    /**
     * @param $comment_ID
     * @return void
     */
    public function setComment_ID($comment_ID)
    {
        $comment_ID = (int)$comment_ID;
        if ($comment_ID > 0) {
            $this->comment_ID = $comment_ID;
        }
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     * @return void
     */
    public function setText($text)
    {
        if (is_string($text)) {
            $this->text = $text;
        }
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param $author
     * @return void
     */
    public function setAuthor($author)
    {
        $author = (int)$author;
        if ($author > 0) {
            $this->author = $author;
        }
    }

    /**
     * @return string
     */
    public function getAuthor_username()
    {
        return $this->author_username;
    }

    /**
     * @return int
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param $ticket
     * @return void
     */
    public function setTicket($ticket)
    {
        $ticket = (int)$ticket;
        if ($ticket > 0) {
            $this->ticket = $ticket;
        }
    }


}