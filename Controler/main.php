<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  MAIN  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The main controler of the app.
/// It redirects to the correct controller.

if (empty($_GET['url']))
{
    $page = 'homepage';
}
else
{
    $page = $_GET['url'];
}

require 'display.php';

switch ($_GET['url'])
{
    case 'login' :
        isset($_GET['id']) ? $page = $_GET['id'] : $page = null;

        $layout = new Deprecated\Layout($layoutTemplate);
        (new Deprecated\ViewLogin($layout, $page))->display();
        break;
    case 'register' :
        isset($_GET['id']) ? $page = $_GET['id'] : $page = null;
        $layout = new Deprecated\Layout($layoutTemplate);
        if(!isset($error))
            $error = null;
        (new Deprecated\ViewRegister($layout, $page, $error))->display();
        break;
    case 'logout' :
        session_unset();
        session_destroy();
        header("Location: /");
        break;
    case 'posts' :
        $layout = new Deprecated\Layout($layoutTemplate);
        if(!isset($_SESSION['isLogged']))
            header('Location: /login&id='.$url);
        else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $controller->getCompleteTicketsById($accessorsLectors, $dataGetting, $id);
            } else {
                $controller->getCompleteTickets($accessorsLectors, $dataGetting);
            }
            (new Deprecated\ViewTickets($layout, $presenter))->display();
        }
        break;
    case 'categories' :
        $layout = new Deprecated\Layout($layoutTemplate);
        if(!isset($_SESSION['isLogged']))
            header('Location: /login&id='.$url);
        else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $controller->getTicketByCatgoriesById($accessorsLectors, $dataGetting, $id);
            } else {
                $controller->getTicketByCatgories($accessorsLectors, $dataGetting);
            }
            (new Deprecated\ViewCategories($layout, $presenter))->display();
        }
        break;
    case 'error' :
        $layout = new Deprecated\Layout($layoutTemplate);
        (new Deprecated\ViewError($layout, $error, $redirect))->display();
        break;
    default:
        header('Status: 404 Not Found');
        echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
        break;
}