<?php

namespace controls;

class Controller
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getCompleteTickets($ticketsGetting, $ticketAccessLector, $commentsGetting,$commentAccessLector, $usersGetting, $userAccessLector){
        $commentsGetting->resetOutputDataComments();

        $ticketsGetting->getTickets($ticketAccessLector);
        foreach ($this->outputData->getOutputDataTickets() as $ticket) {
            $commentsGetting->addCommentsByTicketId($commentAccessLector, $ticket->getTicket_ID());
            $usersGetting->addUserById($userAccessLector, $ticket->getAuthor());
        }
    }

    public function getCompleteTicketsById($ticketsGetting, $ticketAccessLector, $commentsGetting,$commentAccessLector, $usersGetting, $userAccessLector, $id){
        $commentsGetting->resetOutputDataComments();
        $ticketsGetting->getTicketById($ticketAccessLector, $id);
        $ticket = $this->outputData->getOutputDataTickets()[0];
        $commentsGetting->addCommentsByTicketId($commentAccessLector, $ticket->getTicket_ID());
        $usersGetting->addUserById($userAccessLector, $ticket->getAuthor());

    }





}