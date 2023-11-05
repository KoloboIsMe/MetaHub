<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  FIVE POSTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Five Posts model. Used to store 5 posts and their author's username in $posts.
global $ticketTable, $categorizedTable, $commentTable;

// Get 5 tickets
$limit = $ticketTable->getLimit();

if (($tickets = $ticketTable->setLimit('5')->select()) === FALSE)
{
    return;
}

$ticketTable->setLimit($limit);
unset($limit);

// Get categories and comment of the 5 tickets
foreach ($tickets->getData() as $ticket)
{
    $categories[] = $categorizedTable->categoriesOf($ticket);
    $comments[] = $commentTable->commentsOn($ticket);
}

return;