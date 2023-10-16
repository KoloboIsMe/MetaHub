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

define('__ROOT__', realpath(dirname(__DIR__) . "/"))

?>
