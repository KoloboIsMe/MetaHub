<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  SINGLETONS  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Instantiates all Singletons.

try {
    $dbAdmin = \Framework\database\Connexion::getInstance("serveur_admin");
    $dbLector = \Framework\database\Connexion::getInstance("serveur_lecture");
} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

$categoryTable = new Framework\Database\Table\CategoryTable($dbLector);
$commentTable = new Framework\Database\Table\CommentTable($dbLector);
$ticketTable = new Framework\Database\Table\TicketTable($dbLector);
$userTable = new Framework\Database\Table\UserTable($dbLector);

return;