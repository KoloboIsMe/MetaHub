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

    /**
     * @param mixed $ticket_ID
     */
    public function setTicketID($ticket_ID): void
    {
        $this->ticket_ID = $ticket_ID;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
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
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }


}