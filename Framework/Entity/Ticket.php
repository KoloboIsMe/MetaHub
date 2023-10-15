<?php

namespace Framework\Entity;

class Ticket
{
    private $ticket_ID;
    private $title;
    private $message;
    private $date;
    private $author;
    private $category;

    public function __construct($ticket_ID, $title, $message,$date, $author){
        $this->ticket_ID = $ticket_ID;
        $this->title = $title;
        $this->message = $message;
        $this->author = $author;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTicketID()
    {
        return $this->ticket_ID;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
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
    public function getCategory()
    {
        return $this->category;
    }

}