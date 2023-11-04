<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  FIVE POSTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Five Posts model. Used to store 5 posts and their author's username in $posts.
/// TODO : Find a better name for the file...
global $ticketTable, $categorizedTable, $commentTable;

$limit = $ticketTable->getLimit();

if (($tickets = $ticketTable->setLimit('5')->select()) === FALSE)
{
    return;
}

$ticketTable->setLimit($limit);

foreach ($tickets->getData() as $ticket)
{
    $categories[] = $categorizedTable->categoriesOf($ticket->getId());
    $comments[] = $commentTable->commentsOf($ticket->getId());
}

unset($limit);
return;