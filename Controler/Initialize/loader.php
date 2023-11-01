<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOADER  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Loads all the needed files.
/// TO DO : Create a recursive generic class loader

require 'constants.php';
require 'functions.php';

$databaseDirectory = '../../Framework/Database';
require "$databaseDirectory/Connexion.php";
require "$databaseDirectory/Record.php";

$entityDirectory = "$databaseDirectory/Entity";
require "$entityDirectory/Categorized.php";
require "$entityDirectory/Category.php";
require "$entityDirectory/Comment.php";
require "$entityDirectory/Entity.php";
require "$entityDirectory/IdentifiedEntity.php";
require "$entityDirectory/Ticket.php";
require "$entityDirectory/User.php";

$tableDirectory = "$databaseDirectory/Table";
require "$tableDirectory/CategorizedTable.php";
require "$tableDirectory/CategoryTable.php";
require "$tableDirectory/CommentTable.php";
require "$tableDirectory/Database.php";
require "$tableDirectory/IdentifiedTable.php";
require "$tableDirectory/Table.php";
require "$tableDirectory/TicketTable.php";
require "$tableDirectory/UserTable.php";

try {
    $dbAdmin = \Framework\database\Connexion::getInstance("serveur_admin");
    $dbLector = \Framework\database\Connexion::getInstance("serveur_lecture");
} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}
require 'singletons.php';

return;