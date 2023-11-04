<?php

namespace service;

class TicketsGetting
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
    public function existsTicket($dataccess, $ticketID)
    {
        return $dataccess->existsTicket($ticketID);
    }
    public function getPosts($dataccess)
    {

        $posts = [];
        foreach ($dataccess->getTicketsID() as $ticketId) {
            $posts[] = $dataccess->getPostById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }

    public function getPostById($dataccess, $id)
    {
        $posts = $dataccess->getPostById($id);
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
        return $dataccess->createTicket($title, $message, date("Y-m-d H:i:s"), $_SESSION['user_ID']);
    }

    public function addCategoriesToTicket($ticketAccess, $categories, $ticketID)
    {
        foreach ($categories as $category) {
            $ticketAccess->addCategoryToTicket($ticketAccess->getCategoryIdByLabel($category), $ticketID);
        }
    }

    public function deleteTicket($dataccess)
    {
        $dataccess->deleteTicket($_GET['id']);
    }

    public function editTicket($dataccess, $id, $title, $message)
    {
        $dataccess->editTicket($id, $title, $message);
    }

    public function getPostsIdByUserId($dataccess, $id)
    {
        return $dataccess->getPostsIdByUserId($id);
    }

    public function getUserPosts($dataccess, $postsId)
    {
        $posts = [];
        foreach ($postsId as $postID) {
            $posts[] = $dataccess->getPostById($postID);
        }
        $this->outputData->setOutputData($posts);
    }
    public function isTicketOwner($dataccess, $ticketID, $user_ID){
        if($dataccess->existsTicket($ticketID) && $dataccess->isTicketOwner($ticketID, $user_ID))
            return true;
        return false;
    }

}