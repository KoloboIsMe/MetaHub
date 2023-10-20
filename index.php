<?php

include_once 'controls/Controller.php';
include_once 'controls/Presenter.php';

include_once 'database/SPDO.php';
include_once 'database/TicketAccess.php';

include_once 'gui/Layout.php';
include_once 'gui/View.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewRegister.php';
include_once 'gui/ViewHomepage.php';
include_once 'gui/ViewTickets.php';

include_once "service/OutputData.php";
include_once "service/TicketsGetting.php";

$dbAdmin = null;
$dbLector = null;
try {

    define("CHEMIN_VERS_FICHIER_INI", 'config.ini');
    define("BASE_DE_DONNEES", 'metahub_login');
    // construction du modèle
    $dbAdmin = database\SPDO::getInstance("serveur_admin");
    $dbLector = database\SPDO::getInstance("serveur_lecture");

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

$ticketAccessLector = new database\TicketAccess($dbLector);

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new service\OutputData();

// initialisation du controller
$controller = new controls\Controller($outputData);

// initialisation du presenter avec accès aux données
$presenter = new controls\Presenter($outputData);

//initialisation des services
$ticketsGetting = new service\TicketsGetting($outputData);


// chemin de l'URL demandée au navigateur
if(isset($_GET['url']))
    $url = $_GET['url'];
else
    $url = '';

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
    $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}

if ('' == $url && !isset($_SESSION['isLogged'])) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewHomepage($layout))->display();

}elseif ('login' == $url && !isset($_SESSION['isLogged'])) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewLogin($layout))->display();

}elseif ('register' == $url && !isset($_SESSION['isLogged'])) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewRegister($layout))->display();

}elseif ('posts' == $url ) {
    $controller->getCompletePosts($ticketAccessLector);
    $ticketsGetting->getTickets($ticketAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewTickets($layout, $presenter))->display();

}elseif ('posts/:id' == $url ) {

    echo ':id';
}
else{
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}