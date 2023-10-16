<?php

include 'Framework/Database/DataBaseConnexion.php';
require 'Framework/Database/UserDatabase.php';
require 'Framework/Database/TicketDatabase.php';
require "Framework/Database/CommentDatabase.php";
require 'Framework/Database/CategoryDatabase.php';
require 'Framework/Entity/User.php';
require 'Framework/Entity/Ticket.php';
require 'Framework/Entity/Comment.php';
require 'Framework/Entity/Category.php';

$userDB = new \Framework\Database\UserDatabase();
$ticketDB = new \Framework\Database\TicketDatabase();
$commentDB = new \Framework\Database\CommentDatabase();
$categoryDB = new \Framework\Database\CategoryDatabase();

$user = new \Framework\Entity\User(null, "test2", "test", date("Y-m-d"), date("Y-m-d"));

$ticket0 = new \Framework\Entity\Ticket(1, "Titre1", "Ceci est un message test pour le ticket 1", date("Y-m-d"), 32);
$ticket1 = new \Framework\Entity\Ticket(2, "Titre2", "Ceci est un message test pour le ticket 2", date("Y-m-d"), 32);
$ticket2 = new \Framework\Entity\Ticket(3, "Titre3", "Ceci est un message test pour le ticket 3", date("Y-m-d"), 32);
$ticket3 = new \Framework\Entity\Ticket(4, "Titre4", "Ceci est un message test pour le ticket 4", date("Y-m-d"), 32);
$ticket4 = new \Framework\Entity\Ticket(5, "Titre5", "Ceci est un message test pour le ticket 5", date("Y-m-d"), 32);
$ticket5 = new \Framework\Entity\Ticket(6, "Titre6", "Ceci est un message test pour le ticket 6", date("Y-m-d"), 32);
$ticket6 = new \Framework\Entity\Ticket(7, "Titre7", "Ceci est un message test pour le ticket 7", date("Y-m-d"), 32);

$comment = new \Framework\Entity\Comment(null, "test", date("Y-m-d"), 32,17);
$category = new \Framework\Entity\Category(1, "test", "test");

//$userDB->insert($user);
//$categoryDB->insert($category);

//$ticketDB->insert($ticket0);
//$ticketDB->insert($ticket1);
//$ticketDB->insert($ticket2);
//$ticketDB->insert($ticket3);
//$ticketDB->insert($ticket4);
//$ticketDB->insert($ticket5);
//$ticketDB->insert($ticket6);

//$commentDB->insert($comment);

//var_dump($userDB->selectUser("user_ID", 32));
//var_dump($categoryDB->selectCategory("ID", 5));
//var_dump($ticketDB->selectTicket("ticket_ID", 17));
//var_dump($ticketDB->selectFiveLeast());
//var_dump($ticketDB->selectAllTicket());
var_dump($ticketDB->deleteTicket($ticket0));

//var_dump($commentDB->selectComment("comment_ID", 9));

?>