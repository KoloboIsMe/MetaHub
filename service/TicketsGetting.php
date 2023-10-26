<?php

namespace service;

class TicketsGetting
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getPosts($dataccess)
    {

        $posts = [];
        foreach ($dataccess->getTicketsID() as $ticketId) {
            $posts[] = $dataccess->getPostById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }

    public function get5LastPosts($dataccess)
    {
        $posts = [];
        foreach ($dataccess->get5LastTicketsID() as $ticketId) {
            $posts[] = $dataccess->getPostById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }

    public function getPostById($dataccess, $id)
    {
        $posts = $dataccess->getPostById($id);
        $this->outputData->setOutputData($posts);
    }

    public function getCategoryPosts($dataccess, $postsId)
    {
        $posts = [];
        foreach ($postsId as $postID) {
            $posts[] = $dataccess->getPostById($postID);
        }
        $this->outputData->setOutputData($posts);
    }

    public function createTicket($dataccess, $title, $message)
    {
        $dataccess->createTicket($title, $message, date("Y-m-d"), $_SESSION['user_ID']);
    }
}