<?php

include_once 'controls/Controller.php';
include_once 'controls/Presenter.php';

include_once 'database/CategoryAccess.php';
include_once 'database/CommentAccess.php';
include_once 'database/SPDO.php';
include_once 'database/TicketAccess.php';
include_once 'database/UserAccess.php';

include_once 'entities/Category.php';
include_once 'entities/Comment.php';
include_once 'entities/Ticket.php';
include_once 'entities/User.php';

include_once 'gui/Layout.php';
include_once 'gui/View.php';
include_once 'gui/ViewCategories.php';
include_once 'gui/ViewHomepage.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewRegister.php';
include_once 'gui/ViewTickets.php';

include_once 'service/CategoriesGetting.php';
include_once "service/CommentsGetting.php";
include_once "service/OutputData.php";
include_once "service/TicketsGetting.php";
include_once "service/UsersGetting.php";

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
$categoryAccessLector = new database\CategoryAccess($dbLector);
$commentAccessLector = new database\CommentAccess($dbLector);
$ticketAccessLector = new database\TicketAccess($dbLector);
$userAccessLector = new database\UserAccess($dbLector);
$accessors = array('categoryAccessLector' => $categoryAccessLector, 'ticketAccessLector' => $ticketAccessLector, 'commentAccessLector' =>$commentAccessLector, 'userAccessLector' =>$userAccessLector);

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new service\OutputData();

// initialisation du controller avec accès a la structure pour le transfert des données
$controller = new controls\Controller($outputData);

// initialisation du presenter avec accès a la structure pour le transfert des données
$presenter = new controls\Presenter($outputData);

//initialisation des services avec la structure pour le transfert des données
$categoriesGetting = new service\CategoriesGetting($outputData);
$ticketsGetting = new service\TicketsGetting($outputData);
$commentsGetting = new service\CommentsGetting($outputData);
$usersGetting = new service\UsersGetting($outputData);
$dataGetting = array('categoriesGetting' => $categoriesGetting, 'ticketsGetting' => $ticketsGetting, 'commentsGetting' =>$commentsGetting, 'usersGetting' =>$usersGetting);


// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $controller->getCompleteTicketsById($accessors, $dataGetting, $id);
    }else {
        $controller->getCompleteTickets($accessors, $dataGetting);
    }
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewTickets($layout, $presenter))->display();

}elseif ('categories' == $url ) {

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $controller->getTicketByCatgoriesById($accessors, $dataGetting, $id);
    }else {
        $controller->getTicketByCatgories($accessors, $dataGetting);
    }
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCategories($layout, $presenter))->display();

}

//elseif (preg_match("/^posts\/\d+$/",$url)===1) {      //cas avec url posts/:id
//    $id = explode('/',$url)[1];
//    $ticketsGetting->getTicketById($ticketAccessLector, $id);
//    $layout = new gui\Layout($layoutTemplate);
//    (new gui\ViewTickets($layout, $presenter))->display();
//
//}

else{
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}