<?php
if(!isset($user, $title, $message, $categories))
{
    return;
}
use Framework\Database\Entity\Ticket;

global $ticketTable, $categorizedTable;

$userId = is_int($user) ? $user : $user->getId();
$ticket = Ticket::post($title,$message,$userId);

$ticketTable->insert(Ticket::post($title,$message,$userId));

$categorizedTable->categorize($ticket, $categories);

return;