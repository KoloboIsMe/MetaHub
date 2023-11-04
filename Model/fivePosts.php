<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  FIVE POSTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Five Posts model. Used to store 5 posts and their author's username in $posts.
/// TODO : Find a better name for the file...
global $ticketTable;

$limit = $ticketTable->getLimit();

if ($tickets = $ticketTable->setLimit('5')->select() === FALSE)
{
    $posts = FALSE;
    return;
}

$ticketTable->setLimit($limit);
unset($limit);
return;