<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  DISPLAY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The display controler.
/// Displays a given view.

require '../View/header.php';
switch ($page) {
    case 'login' :
        // declare needed variables
        require '../View/login.php';
        break;
    case 'register' :
        // declare needed variables
        require '../View/register.php';
        break;
    case 'logout' :
        // declare needed variables
        require '../View/logout.php';
        break;
    case 'posts' :
        // declare needed variables
        require '../View/posts.php';
        break;
    case 'categories' :
        // declare needed variables
        require '../View/categories.php';
        break;
    case 'error' :
        // declare needed variables
        require '../View/error.php';
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
        break;
}
require '../View/footer.php';
exit;