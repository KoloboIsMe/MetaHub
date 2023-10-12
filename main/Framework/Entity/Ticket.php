<?php

namespace Entity;

class Ticket
{
    private $ID;
    private $title;
    private $message;
    private $date;
    private $author;
    private $category;

    public function __construct($title = "untitled", $message = NULL, $author = NULL, $categories = []){
        $this->title = $title;
        $this->message = $message;
        $this->author = $author;
        $this->category = $categories;
        $this->date = date('d/m/Y');
    }

    public function getTitle(): mixed
    {
        return $this->title;
    }

    public function setTitle(mixed $title): void
    {
        $this->title = $title;
    }

    public function getMessage(): mixed
    {
        return $this->message;
    }

    public function setMessage(mixed $message): void
    {
        $this->message = $message;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getAuthor(): mixed
    {
        return $this->author;
    }

    public function setAuthor(mixed $author): void
    {
        $this->author = $author;
    }

    public function getCategory(): mixed
    {
        return $this->category;
    }

    public function setCategory(mixed $category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }

}