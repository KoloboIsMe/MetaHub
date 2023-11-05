<?php

namespace entities;

class Post
{
    private $ticket;
    private $categories;
    private $comments;
    private $user;

    public function __construct($ticket, $categories, $comments, $user)
    {
        $this->ticket = $ticket;
        $this->categories = $categories;
        $this->comments = $comments;
        $this->user = $user;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getUser()
    {
        return $this->user;
    }

}