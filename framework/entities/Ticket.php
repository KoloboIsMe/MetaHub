<?php

namespace Framework\entities;

class Ticket
{
    private $ticket_ID;
    private $title;
    private $message;
    private $date;
    private $author;
    private $category;

    //Constructeur
    public function __construct(array $data){
        $this->hydrate($data);
    }
    //hydratatation
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }

    //Setters
    public function setTicket_ID($ticket_ID){
        $ticket_ID = (int) $ticket_ID;
        if($ticket_ID > 0){
            $this->ticket_ID = $ticket_ID;
        }
    }
    public function setTitle($title){
        if(is_string($title)){
            $this->title = $title;
        }
    }
    public function setMessage($message){
        if(is_string($message)){
            $this->message = $message;
        }
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setAuthor($author){
        $author = (int) $author;
        if($author > 0){
            $this->author = $author;
        }
    }

    //Getters
    public function getTicket_ID(){
        return $this->ticket_ID;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getMessage(){
        return $this->message;
    }
    public function getDate(){
        return $this->date;
    }
    public function getAuthor(){
        return $this->author;
    }


}