<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  FUNCTIONS  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// All the controller functions.
function getCompleteTickets($outputData, $accessors, $dataGetting){
    $dataGetting['commentsGetting']->resetOutputDataComments();
    $dataGetting['usersGetting']->resetOutputDataUsers();
    $dataGetting['categoriesGetting']->resetOutputDataCategories();

    $dataGetting['ticketsGetting']->getTickets($accessors['ticketAccessLector']);
    foreach ($outputData->getOutputDataTickets() as $ticket) {
        $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
        $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
        $dataGetting['categoriesGetting']->addCategoriesWithTicket($accessors['categoryAccessLector'], $ticket->getTicket_ID());
    }
}

// [...]