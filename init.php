<?php

///////////////////////////////////////////////////////////////////////////////
///////////////////////// INITIALIZATION FILE /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Load all classes and instantiates every Singleton

include 'Controler/Controller.php';
include 'Controler/Presenter.php';

include 'Framework/Database/CategoryAccess.php';
include 'Framework/Database/CommentAccess.php';
include 'Framework/Database/SPDO.php';
include 'Framework/Database/TicketAccess.php';
include 'Framework/Database/UserAccess.php';

include 'Framework/Entity/Category.php';
include 'Framework/Entity/Comment.php';
include 'Framework/Entity/Ticket.php';
include 'Framework/Entity/User.php';

include 'View/Layout.php';
include 'View/View.php';
include 'View/ViewCategories.php';
include 'View/ViewError.php';
include 'View/ViewHomepage.php';
include 'View/ViewLogin.php';
include 'View/ViewRegister.php';
include 'View/ViewTickets.php';

include 'Model/CategoriesGetting.php';
include "Model/CommentsGetting.php";
include "Model/OutputData.php";
include "Model/TicketsGetting.php";
include "Model/UsersGetting.php";

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

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}

if ('registerAction' === $_GET['url'] && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->registerAction($usersGetting, $userAccess);
    if ($error){
        $url = 'register'; // change
    }else
        $url = 'login_verification'; // change
}
if ('login_verification' === $_GET['url'] && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->authentificateAction($usersGetting, $userAccessLector);
    if ($error){
        $page ? $redirect = 'login&id='.$page : $redirect = 'login';
        $url = 'error'; // change
    }else{
        $url = '/'; // change
        $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
    }
}
