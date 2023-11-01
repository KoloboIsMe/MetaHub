<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  DISPLAY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The display controler.
/// Displays a given view.

$viewDirectory = '../View';
$bodyDirectory = "$viewDirectory/Body";

require "$viewDirectory/header.php";
switch ($page) {
    case 'login' :
        // declare needed variables
        require "$bodyDirectory/login.php";
        break;
    case 'register' :
        // declare needed variables
        require "$viewDirectory/register.php";
        break;
    case 'logout' :
        session_unset();
        session_destroy();
        header("Location: /");
        // declare needed variables
        require "$viewDirectory/logout.php";
        break;
    case 'posts' :
        // declare needed variables
        require "$viewDirectory/posts.php";
        break;
    case 'categories' :
        // declare needed variables
        require "$viewDirectory/categories.php";
        break;
    case 'error' :
        // declare needed variables
        require "$viewDirectory/error.php";
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
        break;
}
require "$viewDirectory/footer.php";
exit;