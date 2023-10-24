<?php

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////// INDEX ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Entrance point of the application

require 'init.php';

// Call the main controler

$dbAdmin = null;
$dbLector = null;
try {

    define("CHEMIN_VERS_FICHIER_INI", 'config.ini');
    define("BASE_DE_DONNEES", 'metahub_login');
    // construction du modèle
    $dbAdmin = \Framework\database\SPDO::getInstance("serveur_admin");
    $dbLector = \Framework\database\SPDO::getInstance("serveur_lecture");

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}
$categoryAccessLector = new \Framework\database\CategoryAccess($dbLector);
$commentAccessLector = new \Framework\database\CommentAccess($dbLector);
$ticketAccessLector = new \Framework\database\TicketAccess($dbLector);
$userAccessLector = new \Framework\database\UserAccess($dbLector);
$accessorsLectors = array('categoryAccessLector' => $categoryAccessLector, 'ticketAccessLector' => $ticketAccessLector, 'commentAccessLector' =>$commentAccessLector, 'userAccessLector' =>$userAccessLector);
$userAccess = new \Framework\database\UserAccess($dbAdmin);


// initialisation de l'output dans une structure pour le transfert des données
$outputData = new Deprecated\OutputData();

// initialisation du controller avec accès a la structure pour le transfert des données
$controller = new Controler\Controller($outputData);

// initialisation du presenter avec accès a la structure pour le transfert des données
$presenter = new Controler\Presenter($outputData);

//initialisation des services avec la structure pour le transfert des données
$categoriesGetting = new service\CategoriesGetting($outputData);
$ticketsGetting = new service\TicketsGetting($outputData);
$commentsGetting = new service\CommentsGetting($outputData);
$usersGetting = new service\UsersGetting($outputData);
$dataGetting = array('categoriesGetting' => $categoriesGetting, 'ticketsGetting' => $ticketsGetting, 'commentsGetting' =>$commentsGetting, 'usersGetting' =>$usersGetting);

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}

if ('registerAction' == $url && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->registerAction($usersGetting, $userAccess);
    if ($error){
        $url = 'register';
    }else
        $url = 'login_verification';
}
if ('login_verification' == $url && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->authentificateAction($usersGetting, $userAccessLector);
    if ($error){
        $page ? $redirect = 'login&id='.$page : $redirect = 'login';
        $url = 'error';
    }else{
        $url = '/';
        $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
    }
}


if ('' == $url || '/' == $url) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewHomepage($layout))->display();

}elseif ('login' == $url) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewLogin($layout, $page))->display();

}elseif ('register' == $url) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;
    $layout = new gui\Layout($layoutTemplate);
    if(!isset($error))
        $error = null;
    (new gui\ViewRegister($layout, $page, $error))->display();

}elseif ('logout' == $url) {

    session_unset();
    session_destroy();
    header("Location: /");

}elseif ('posts' == $url ) {

    $layout = new gui\Layout($layoutTemplate);
    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);
    else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->getCompleteTicketsById($accessorsLectors, $dataGetting, $id);
        } else {
            $controller->getCompleteTickets($accessorsLectors, $dataGetting);
        }
        (new gui\ViewTickets($layout, $presenter))->display();
    }

}elseif ('categories' == $url ) {
    $layout = new gui\Layout($layoutTemplate);
    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);
    else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->getTicketByCatgoriesById($accessorsLectors, $dataGetting, $id);
        } else {
            $controller->getTicketByCatgories($accessorsLectors, $dataGetting);
        }
        (new gui\ViewCategories($layout, $presenter))->display();
    }

}

//elseif (preg_match("/^posts\/\d+$/",$url)===1) {      //cas avec url posts/:id
//    $id = explode('/',$url)[1];
//    $ticketsGetting->getTicketById($ticketAccessLector, $id);
//    $layout = new gui\Layout($layoutTemplate);
//    (new gui\ViewTickets($layout, $presenter))->display();
//
//}
elseif ('error' == $url) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, $error, $redirect))->display();

}
else{
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}