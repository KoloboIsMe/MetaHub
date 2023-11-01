<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  FIVE POSTS  ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The Fie Posts. Used to store 5 posts and their author's username in $posts.
/// TODO : Find a better name for the file...
global $ticketTable, $userTable;

$limit = $ticketTable->getLimit();
if ($response = $ticketTable->setLimit('5')->select() === FALSE)
{
    $posts = FALSE;
    return;
}

$data = $response->getData();

foreach ($data as $datum)
{
    $datum['username'] = $userTable->select($datum['author']);
}

$posts = $data;

$ticketTable->setLimit($limit);
unset($limit, $response, $datum, $data);
return;