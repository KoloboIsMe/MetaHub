<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  FIVE POSTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Five Posts model. Used to store 5 posts and their author's username in $posts.
/// TODO : Find a better name for the file...
global $ticketTable, $userTable, $commentTable, $categoryTable, $categorizedTable;

$limit = $ticketTable->getLimit();

if ($response = $ticketTable->setLimit('5')->select() === FALSE)
{
    $posts = FALSE;
    return;
}

foreach ($response->getData() as $ticket)
{
    $datum['username'] = $userTable->select($ticket['author']);
}

$posts = $data;

$ticketTable->setLimit($limit);
unset($limit, $response, $datum, $data);
return;