<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  SINGLETONS  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Instantiates all Singletons.

use Framework\database\Connexion as Connexion;

try {
    $connexion = Connexion::getInstance("serveur_lecture");
} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

$categoryTable = new Framework\Database\Table\CategoryTable($connexion);
$commentTable = new Framework\Database\Table\CommentTable($connexion);
$ticketTable = new Framework\Database\Table\TicketTable($connexion);
$userTable = new Framework\Database\Table\UserTable($connexion);
$categorizedTable = new Framework\Database\Table\CategorizedTable($connexion);

return;