<?php

use Entity\Ticket;

require_once('Framework/Database/TicketDatabase.php');
require_once('Framework/Entity/Ticket.php');

echo 'Test de la classe TicketDataBase <br>';

$ticket = new Ticket();
$ticket->setTitle('Titre du post !');
$ticket->setMessage('Corps du message du post');
$ticket->setAuthor(07);

$ticketDB = new TicketDatabase();
$ticketDB -> TESTinsert($ticket);

?>