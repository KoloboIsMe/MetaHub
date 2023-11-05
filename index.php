<?php

include_once 'controls/Controller.php';
include_once 'controls/Presenter.php';

include_once 'Framework/database/CategoryAccess.php';
include_once 'Framework/database/CommentAccess.php';
include_once 'Framework/database/GeneralAccess.php';
include_once 'Framework/database/SPDO.php';
include_once 'Framework/database/TicketAccess.php';
include_once 'Framework/database/UserAccess.php';

include_once 'Framework/entities/Category.php';
include_once 'Framework/entities/Comment.php';
include_once 'Framework/entities/Post.php';
include_once 'Framework/entities/Ticket.php';
include_once 'Framework/entities/User.php';

include_once 'gui/Layout.php';
include_once 'gui/View.php';
include_once 'gui/ViewCategories.php';
include_once 'gui/ViewCreateCategory.php';
include_once 'gui/ViewCreatePosts.php';
include_once 'gui/ViewEditTicket.php';
include_once 'gui/ViewError.php';
include_once 'gui/ViewHomepage.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewRegister.php';
include_once 'gui/ViewPosts.php';
include_once 'gui/ViewUserEdit.php';
include_once 'gui/ViewUsers.php';

include_once 'services/CategoriesService.php';
include_once "services/CommentsService.php";
include_once "services/OutputData.php";
include_once "services/TicketsService.php";
include_once "services/UsersService.php";

$dbAdmin = null;
$dbLector = null;
try {
    putenv("IPADRESS=mysql-metahub.alwaysdata.net");
    putenv("DBNAME=metahub_login");
    putenv("ADMIN=metahub");
    putenv("LECTOR=metahub_lector");
    putenv("ADMINPASSWORD=MetaHubAdmin13.");
    putenv("LECTORPASSWORD=MetaHubAdmin13.");

    // construction du modèle
    $dbAdmin = database\SPDO::getInstance("ADMIN");
    $dbLector = database\SPDO::getInstance("LECTOR");

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

$categoryAccessLector = new database\CategoryAccess($dbLector);
$commentAccessLector = new database\CommentAccess($dbLector);
$ticketAccessLector = new database\TicketAccess($dbLector);
$userAccessLector = new database\UserAccess($dbLector);
$generalAccessLector = new database\GeneralAccess($dbAdmin);

$ticketAccess = new database\TicketAccess($dbAdmin);
$userAccess = new database\UserAccess($dbAdmin);
$commentAccess = new database\CommentAccess($dbAdmin);
$categoryAccess = new database\CategoryAccess($dbAdmin);
$generalAccess = new database\GeneralAccess($dbAdmin);

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new services\OutputData();

// initialisation du controller avec accès a la structure pour le transfert des données
$controller = new controls\Controller($outputData);

// initialisation du presenter avec accès a la structure pour le transfert des données
$presenter = new controls\Presenter($outputData);

//initialisation des services avec la structure pour le transfert des données
$categoriesService = new services\CategoriesService($outputData);
$ticketsService = new services\TicketsService($outputData);
$commentsService = new services\CommentsService($outputData);
$usersService = new services\UsersService($outputData);

// chemin de l'URL demandée au navigateur
$url = $_GET['url'] ?? '';

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    if (isset($_SESSION['level']) && $_SESSION['level'] > 0)
        $layoutTemplate = 'gui/layoutLoggedAdmin.html';
    else
        $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}


if (isset($_GET['action'])) {
    if ('registerAction' == $_GET['action'] && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {

        $page = $_GET['id'] ?? $page = null;
        $error = $controller->registerAction($usersService, $userAccess);
        if ($error) {
            $url = 'register';
        } else
            $_GET['action'] = 'login_verification';
    }
    if ('login_verification' == $_GET['action'] && isset($_POST['username']) && isset($_POST['password'])) {

        $page = $_GET['id'] ?? $page = null;
        $error = $controller->authenticateAction($usersService, $userAccess);
        if ($error) {
            $page ? $redirect = 'login&id=' . $page : $redirect = 'login';
            $url = 'error';
        } else {
            $page ? header("refresh:0;url=/$page") : header("refresh:0;url=/");
        }
    }

    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {

        if ('createPostsAction' == $_GET['action'] && isset($_POST["title"]) && isset($_POST["message"])) {

            $controller->createTicketAction($ticketsService, $ticketAccess, $categoriesService ,$categoryAccess, $generalAccess);
            header("refresh:0;url=/");

        }
        if ('deleteTicketAction' == $_GET['action'] && isset($_GET['id'])) {

            $error = $controller->deleteTicket($ticketsService, $ticketAccess, $generalAccess, $_GET['id']);
            if ($error) {
                $redirect = '/';
                $url = 'error';
            }

        } elseif ('deleteUserAction' == $_GET['action'] && isset($_GET['id'])) {

            $error = $controller->deleteUser($usersService, $userAccess, $generalAccess, $_GET['id']);
            if ($error) {
                $redirect = '/';
                $url = 'error';
            } else {
                if ($_GET['id'] == $_SESSION['user_ID']) {
                    session_unset();
                    header("refresh:0;url=/");
                }
            }

        } elseif ('deleteCommentAction' == $_GET['action'] && isset($_GET['id'])) {

            $error = $controller->deleteComment($commentsService, $commentAccess, $_GET['id']);
            if ($error) {
                $redirect = '/';
                $url = 'error';
            }

        } elseif ('deleteCategoryAction' == $_GET['action'] && isset($_GET['id'])) {

            $error = $controller->deleteCategory($generalAccess, $_GET['id']);
            if ($error) {
                $redirect = '/';
                $url = 'error';
            }

        } elseif ('editTicketAction' == $_GET['action'] && isset($_GET['id']) && isset($_POST["title"]) && isset($_POST["message"])) {

            $error = $controller->editTicket($ticketsService, $ticketAccess);
            if ($error) {
                $redirect = '/';
                $url = 'error';
            } else {
                header("refresh:0;url=/");
            }

        } elseif ('editUserInfoAction' == $_GET['action'] && isset($_POST['username']) && isset($_POST['old_password'])) {

            $error = $controller->updateUserAction($usersService, $userAccess);
            if ($error) {
                $redirect = 'userEdit';
                $url = 'error';
            } else {
                session_unset();
                $url = '/';
                $controller->authenticateAction($usersService, $userAccess);
                header("refresh:0;url=/");
            }

        } elseif ('createComment' == $_GET['action'] && isset($_POST["text"]) && isset($_GET['id'])) {

            $commentsService->createComment($commentAccess, $_POST["text"], $_GET['id']);
            header("refresh:0;url=/posts&id=" . $_GET['id']);

        } elseif ('createCategoryAction' == $_GET['action'] && isset($_POST["label"]) && isset($_POST['description'])) {

            $error = $categoriesService->createCategory($categoryAccess, $_POST["label"], $_POST['description']);
            if ($error) {
                $redirect = 'createCategory';
                $url = 'error';
            } else {
                header("refresh:0;url=/categories");
            }
        }
    }
}


if ('' == $url || '/' == $url) {

    $ticketsService->get5LastPosts($ticketAccessLector, $generalAccessLector);
    $categoriesService->add5LastCategories($categoryAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewHomepage($layout, $presenter))->display();

} elseif ('login' == $url) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewLogin($layout, $page))->display();

} elseif ('register' == $url) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;
    $layout = new gui\Layout($layoutTemplate);
    if (!isset($error))
        $error = null;
    (new gui\ViewRegister($layout, $page, $error))->display();

} elseif ('logout' == $url) {

    session_unset();
    session_destroy();
    header("Location: /");

} elseif ('posts' == $url) {

    if (!isset($_SESSION['isLogged']))
        header('Location: /login&id=' . $url);

    if (isset($_GET['id']))
        if ($ticketsService->existsTicket($ticketAccessLector, $_GET['id']))
            $controller->getPostById($_GET['id'], $generalAccessLector);
        else
            header('Location: /');
    else
        $ticketsService->getPosts($ticketAccessLector, $generalAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewPosts($layout, $presenter))->display();

} elseif ('createPosts' == $url) {

    if (!isset($_SESSION['isLogged']))
        header('Location: /login&id=' . $url);

    $categoriesService->getCategories($categoryAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCreatePosts($layout, $presenter))->display();

} elseif ('categories' == $url) {

    if (!isset($_SESSION['isLogged']))
        header('Location: /login&id=' . $url);

    $category = null;
    if (isset($_GET['id'])) {
        if ($categoriesService->existsCategory($categoryAccessLector, $_GET['id'])) {
            $category = $categoriesService->getCategoryById($categoryAccessLector, $_GET['id']);
            $postsID = $generalAccess->getPostsIdByCategoryId($_GET['id']);
            $ticketsService->getCategoryPosts($generalAccessLector, $postsID);
        } else
            header('Location: /');
    } else
        $categoriesService->getCategories($categoryAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCategories($layout, $presenter, $category))->display();

} elseif ('editTicket' == $url && isset($_GET['id']) && $ticketsService->existsTicket($ticketAccessLector, $_GET['id'])) {

    if (!isset($_SESSION['isLogged']))
        header('Location: /login');

    $controller->getPostById($_GET['id'], $generalAccessLector);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewEditTicket($layout, $presenter))->display();

} elseif ('users' == $url) {

    if (!isset($_SESSION['isLogged']))
        header('Location: /login&id=' . $url);

    $user = null;
    if (isset($_GET['id'])) {
        if ($usersService->existsUser($userAccessLector, $_GET['id'])) {
            $user = $usersService->getUserById($userAccessLector, $_GET['id']);
            //liste des id tes tickets de l'user
            $postsID = $generalAccess->getTicketsIdByUserId($_GET['id']);
            $ticketsService->getUserPosts($generalAccessLector, $postsID);
        } else
            header('Location: /');

    } else
        //si l'id nest pas set, afficher tout les user
        $usersService->getUsers($userAccessLector);

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewUsers($layout, $presenter, $user))->display();

} elseif ('userEdit' == $url && isset($_SESSION['user_ID'])) {

    $usersService->setUserById($userAccessLector, $_SESSION['user_ID']);
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewUserEdit($layout, $presenter))->display();

} elseif ('createCategory' == $url && isset($_SESSION['level']) && $_SESSION['level'] > 0) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewCreateCategory($layout))->display();

} elseif ('error' == $url) {

    $error ?? $error = null;
    $redirect ?? $redirect = null;
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, $error, $redirect))->display();

} else {
    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, 'Page introuvable'))->display();
}