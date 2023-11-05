<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////// INDEX ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Entrance point of the application

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();


require 'Controler/Initialize/loader.php';
require 'Controler/main.php';

return;

try {
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

$ticketAccess = new database\TicketAccess($dbAdmin);
$userAccess = new database\UserAccess($dbAdmin);

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}

if ('registerAction' == $url && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->registerAction($usersGetting, $userAccess);
    if ($error){
        $url = 'register';
    }else
        $url = 'login_verification';
}
if ('login_verification' == $url && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->authenticateAction($usersGetting, $userAccess);
    if ($error){
        $page ? $redirect = 'login&id='.$page : $redirect = 'login';
        $url = 'error';
    }else{
        $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
        $url = '/';
    }
}
if ('createPostsAction' == $url && isset($_POST["title"]) && isset($_POST["message"])) {

    $controller->createTicketAction($ticketsGetting, $ticketAccess);
    $url='/';
    header("refresh:0;url=/");
}
if ('deleteTicketAction' == $url && isset($_GET['id'])) {

    $ticketsGetting->deleteTicket($ticketAccess);
    $url='/';
    header("refresh:0;url=/");
}
if ('editTicketAction' == $url && isset($_GET['id']) && isset($_POST["title"]) && isset($_POST["message"])) {

    $ticketsGetting->editTicket($ticketAccess, $_GET['id'], $_POST["title"], $_POST["message"]);
    $url='/';
    header("refresh:0;url=/");
}

if ('' == $url || '/' == $url) {

    $ticketsGetting->get5LastPosts($ticketAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewHomepage($layout, $presenter))->display();

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

    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);

    isset($_GET['id']) ? $ticketsGetting->getPostById($ticketAccessLector, $_GET['id']) : $ticketsGetting->getPosts($ticketAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewPosts($layout, $presenter))->display();

}elseif ('createPosts' == $url ) {

    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);

    $categoriesGetting->getCategories($categoryAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCreatePosts($layout, $presenter))->display();

}elseif ('categories' == $url ) {

    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);

    $category = null;
    if(isset($_GET['id'])) {
        $category = $categoriesGetting->getCategoryById($categoryAccessLector, $_GET['id']);
        $postsID = $categoriesGetting->getPostsIdByCategoryId($categoryAccessLector, $_GET['id']);
        $ticketsGetting->getCategoryPosts($ticketAccessLector, $postsID);
    }else
        $categoriesGetting->getCategories($categoryAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCategories($layout, $presenter, $category))->display();

}elseif ('editTicket' == $url ) {

    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);

    isset($_GET['id']) ? $ticketsGetting->getPostById($ticketAccessLector, $_GET['id']) : $ticketsGetting->getPosts($ticketAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewEditTicket($layout, $presenter))->display();

}elseif ('users' == $url ) {

    if(!isset($_SESSION['isLogged']))
        header('Location: /login&id='.$url);

    $user = null;
    if(isset($_GET['id'])) {
        $user = $usersGetting->getUserById($userAccessLector, $_GET['id']);
        //liste des id tes tickets de l'user
        $postsID = $ticketsGetting->getPostsIdByUserId($userAccessLector, $_GET['id']);
        $ticketsGetting->getUserPosts($ticketAccessLector, $postsID);
    }else
        //si l'id nest pas set, afficher tout les user
        $usersGetting->getUsers($userAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewUsers($layout, $presenter, $user))->display();
}
elseif ('lostmdp/' == $url) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, $error, $redirect))->display();

}
elseif ('error' == $url) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, $error, $redirect))->display();

}
else{
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, 'Page introuvable'))->display();
}