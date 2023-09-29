<?php

namespace Entity;

class Ticket implements Entity
{
    private $ID;
    private $title;
    private $message;
    private $date;
    private $author;
    private $category;

    public function __construct($title = NULL, $message = NULL, $date = NULL, $author = NULL, $category = NULL){
        $this->title = $title;
        $this->message = $message;
        $this->date = $date;
        $this->author = $author;
        $this->category = $category;
    }

    public function setId($newID){
        $this->ID = $newID;
    }
}