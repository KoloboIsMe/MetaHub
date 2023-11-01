<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOADER  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Loads all the needed files.
/// TO DO : Create a recursive generic class loader

require 'constants.php';
require 'functions.php';

$databaseDirectory = __DIR__ . '/../../Framework/Database';
require "$databaseDirectory/Connexion.php";
require "$databaseDirectory/Record.php";

$entityDirectory = "$databaseDirectory/Entity";
require "$entityDirectory/ID.php";
require "$entityDirectory/Entity.php";
require "$entityDirectory/Categorized.php";
require "$entityDirectory/Category.php";
require "$entityDirectory/Comment.php";
require "$entityDirectory/Ticket.php";
require "$entityDirectory/User.php";

$tableDirectory = "$databaseDirectory/Table";
require "$tableDirectory/Requests.php";
require "$tableDirectory/CategorizedTable.php";
require "$tableDirectory/CategoryTable.php";
require "$tableDirectory/CommentTable.php";
require "$tableDirectory/TicketTable.php";
require "$tableDirectory/UserTable.php";

require 'singletons.php';

return;