<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////// INDEX ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Entrance point of the application

require 'Framework/Initialize/constants.php';
require 'Framework/Initialize/loader.php';

try {
    $dbAdmin = \Framework\database\Connexion::getInstance("serveur_admin");
    $dbLector = \Framework\database\Connexion::getInstance("serveur_lecture");
} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

require 'Framework/Initialize/singletons.php';
require 'Framework/Initialize/session.php';
require 'Controler/main.php';

exit;