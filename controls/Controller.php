<?php

namespace controls;

class Controller
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getCompleteTickets($accessors, $dataGetting){
        $dataGetting['commentsGetting']->resetOutputDataComments();
        $dataGetting['usersGetting']->resetOutputDataUsers();
        $dataGetting['categoriesGetting']->resetOutputDataCategories();

        $dataGetting['ticketsGetting']->getTickets($accessors['ticketAccessLector']);
        foreach ($this->outputData->getOutputDataTickets() as $ticket) {
            $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
            $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
            $dataGetting['categoriesGetting']->addCategoriesWithTicket($accessors['categoryAccessLector'], $ticket->getTicket_ID());
        }
    }

    public function getCompleteTicketsById($accessors, $dataGetting, $id){
        $dataGetting['commentsGetting']->resetOutputDataComments();
        $dataGetting['usersGetting']->resetOutputDataUsers();
        $dataGetting['categoriesGetting']->resetOutputDataCategories();

        $dataGetting['ticketsGetting']->getTicketById($accessors['ticketAccessLector'], $id);
        $ticket = $this->outputData->getOutputDataTickets()[0];
        $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
        $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
        $dataGetting['categoriesGetting']->addCategoriesWithTicket($accessors['categoryAccessLector'], $ticket->getTicket_ID());
    }

    public function getTicketByCatgories($accessors, $dataGetting){
        $dataGetting['commentsGetting']->resetOutputDataComments();
        $dataGetting['usersGetting']->resetOutputDataUsers();
        $dataGetting['categoriesGetting']->resetOutputDataCategories();
        $dataGetting['ticketsGetting']->resetOutputDataTickets();

        $dataGetting['categoriesGetting']->getCategories($accessors['categoryAccessLector']);
        foreach ($this->outputData->getOutputDataCategories() as $category) {
            $dataGetting['ticketsGetting']->addTicketsWithCategory($accessors['ticketAccessLector'], $category->getCategory_ID());
            foreach ($this->outputData->getOutputDataTickets($category->getCategory_ID()) as $ticket) {
                $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
                $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
            }
        }
    }

    public function getTicketByCatgoriesById($accessors, $dataGetting, $id){
        $dataGetting['commentsGetting']->resetOutputDataComments();
        $dataGetting['usersGetting']->resetOutputDataUsers();
        $dataGetting['categoriesGetting']->resetOutputDataCategories();
        $dataGetting['ticketsGetting']->resetOutputDataTickets();

        $dataGetting['categoriesGetting']->getCategoryById($accessors['categoryAccessLector'], $id);
        $category = $this->outputData->getOutputDataCategories()[0];
        $dataGetting['ticketsGetting']->addTicketsWithCategory($accessors['ticketAccessLector'], $category->getCategory_ID());
        foreach ($this->outputData->getOutputDataTickets($category->getCategory_ID()) as $ticket) {
            $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
            $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
        }
    }





}