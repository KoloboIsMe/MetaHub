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

$categoryDatabase = new Framework\Database\Table\CategoryTable($dbLector);
$commentDatabase = new Framework\Database\Table\CommentTable($dbLector);
$ticketDatabase = new Framework\Database\Table\TicketTable($dbLector);
$userDatabase = new Framework\Database\Table\UserTable($dbLector);

return;