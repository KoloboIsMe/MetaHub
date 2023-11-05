<?php

namespace entities;

include_once 'Entity.php';

class Ticket extends Entity
{
    /**
     * @var
     */
    private $ticket_ID;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $message;
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $author;

    /**
     * @return int
     */
    public function getTicket_ID()
    {
        return $this->ticket_ID;
    }

    /**
     * @param $ticket_ID
     * @return void
     */
    public function setTicket_ID($ticket_ID)
    {
        $ticket_ID = (int)$ticket_ID;
        if ($ticket_ID > 0) {
            $this->ticket_ID = $ticket_ID;
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return void
     */
    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     * @return void
     */
    public function setMessage($message)
    {
        if (is_string($message)) {
            $this->message = $message;
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
     * @return int
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


}