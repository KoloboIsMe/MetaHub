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

$user = new \Framework\Entity\User(1, "test", "test", date("Y-m-d"), date("Y-m-d"));
$ticket = new \Framework\Entity\Ticket(1, "test", "test", date("Y-m-d"), 32);
$comment = new \Framework\Entity\Comment(null, "test", date("Y-m-d"), 32,17);
$category = new \Framework\Entity\Category(1, "test", "test");

//$userDB->insert($user);
//$categoryDB->insert($category);
//$ticketDB->insert($ticket);
//$commentDB->insert($comment);

//var_dump($userDB->selectUser("user_ID", 32));
//var_dump($categoryDB->selectCategory("ID", 5));
//var_dump($ticketDB->selectTicket("ticket_ID", 17));
//var_dump($commentDB->selectComment("comment_ID", 9));

?>