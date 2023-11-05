<?php

if(!isset($ticket, $author))
{
    return;
}

global $ticketTable;

$ticketID = is_int($ticket) ? $ticket : $ticket->getID();
$authorID = is_int($author) ? $author : $author->getID();

if($authorID !== $ticketTable->select($ticketID)->getData()->getAuthor())
{
    return;
}

$ticketTable->delete($ticketID);

return;