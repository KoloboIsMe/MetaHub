<?php

namespace services;

class TicketsService
{

    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getPosts($userAccess, $generalAccess)
    {

        $posts = [];
        foreach ($userAccess->getTicketsID() as $ticketId) {
            $posts[] = $generalAccess->getPostById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }

    public function get5LastPosts($userAccess, $generalAccess)
    {
        $posts = [];
        foreach ($userAccess->get5LastTicketsID() as $ticketId) {
            $posts[] = $generalAccess->getPostById($ticketId);
        }
        $this->outputData->setOutputData($posts);
    }

    public function getCategoryPosts($generalAccess, $postsId)
    {
        $posts = [];
        foreach ($postsId as $postID) {
            $posts[] = $generalAccess->getPostById($postID);
        }
        $this->outputData->setOutputData($posts);
    }

    public function createTicket($userAccess, $title, $message)
    {
        return $userAccess->createTicket($title, $message, date("Y-m-d H:i"), $_SESSION['user_ID']);
    }

    public function deleteTicket($userAccess)
    {
        $userAccess->deleteTicket($_GET['id']);
    }

    public function editTicket($userAccess, $id, $title, $message)
    {
        $userAccess->editTicket($id, $title, $message);
    }

    public function getPostsIdByUserId($userAccess, $id)
    {
        return $userAccess->getPostsIdByUserId($id);
    }

    public function getUserPosts($generalAccess, $postsId)
    {
        $posts = [];
        foreach ($postsId as $postID) {
            $posts[] = $generalAccess->getPostById($postID);
        }
        $this->outputData->setOutputData($posts);
    }

    public function isTicketOwner($userAccess, $ticketID, $user_ID)
    {
        if ($userAccess->existsTicket($ticketID) && $userAccess->isTicketOwner($ticketID, $user_ID))
            return true;
        return false;
    }

    public function existsTicket($userAccess, $ticketID)
    {
        return $userAccess->existsTicket($ticketID);
    }

}