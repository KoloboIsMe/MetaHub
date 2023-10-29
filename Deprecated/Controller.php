<?php

namespace Deprecated;

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
        $dataGetting['ticketsGetting']->resetOutputDataTickets();

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

    public function authentificateAction($usersGetting, $data)
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $usersGetting->authentificate($_POST['username'], $_POST['password'], $data);
            if (!$this->outputData->getOutputDataUsers()) {
                return 'Mauvais identifiant ou mot de passe !';
            }
            $_SESSION['isLogged'] = true;
            $_SESSION['username'] = $_POST['username'];
        } else {
            return 'Veuillez remplir tous les champs !';
        }
    }

    public function registerAction($usersGetting, $data)
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {
            if ($_POST['password'] !== $_POST['password_confirmation']) {
                return 'Les mots de passe ne correspondent pas !';
            }
            return $usersGetting->register($_POST['username'], $_POST['password'], $data);
        } else {
            return 'Veuillez remplir tous les champs !';
        }
    }






}