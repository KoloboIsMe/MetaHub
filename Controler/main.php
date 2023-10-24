<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  MAIN  ///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The main controler of the app.
/// It redirects to the correct controller.

if (empty($_GET['url'])) {

    $layout = new gui\Layout($layoutTemplate);
    (new Deprecated\ViewHomepage($layout))->display();

}elseif ('login' == $_GET['url']) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;

    $layout = new gui\Layout($layoutTemplate);
    (new Deprecated\ViewLogin($layout, $page))->display();

}elseif ('register' == $_GET['url']) {

    isset($_GET['id']) ? $page = $_GET['id'] : $page = null;
    $layout = new gui\Layout($layoutTemplate);
    if(!isset($error))
        $error = null;
    (new gui\ViewRegister($layout, $page, $error))->display();

}elseif ('logout' == $_GET['url']) {

    session_unset();
    session_destroy();
    header("Location: /");

}elseif ('posts' == $_GET['url'] ) {

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

}elseif ('categories' == $_GET['url'] ) {
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
elseif ('error' == $_GET['url']) {

    $layout = new gui\Layout($layoutTemplate);
    (new gui\ViewError($layout, $error, $redirect))->display();

}
else{
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}