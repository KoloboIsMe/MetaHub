<?php

namespace entities;

include_once 'Entity.php';

class Ticket extends Entity
{
    private $ticket_ID;
    private $title;
    private $message;
    private $date;
    private $author;

    public function getTicket_ID()
    {
        return $this->ticket_ID;
    }

    public function setTicket_ID($ticket_ID)
    {
        $ticket_ID = (int)$ticket_ID;
        if ($ticket_ID > 0) {
            $this->ticket_ID = $ticket_ID;
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        if (is_string($message)) {
            $this->message = $message;
        }
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

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


}