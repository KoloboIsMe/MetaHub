<?php

namespace entities;

class Post
{
    /**
     * @var
     */
    private $ticket;
    /**
     * @var
     */
    private $categories;
    /**
     * @var
     */
    private $comments;
    /**
     * @var
     */
    private $user;

    /**
     * @param $ticket
     * @param $categories
     * @param $comments
     * @param $user
     */
    public function __construct($ticket, $categories, $comments, $user)
    {
        $this->ticket = $ticket;
        $this->categories = $categories;
        $this->comments = $comments;
        $this->user = $user;
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}