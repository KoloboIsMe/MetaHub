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

    public function __construct($title = "untitled", $message = NULL, $author = NULL, $categories = []){
        $this->title = $title;
        $this->message = $message;
        $this->author = $author;
        $this->category = $categories;
        $this->date = date('d/m/Y');
    }

    public function setId($newID){
        $this->ID = $newID;
    }
}