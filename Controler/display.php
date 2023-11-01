<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  DISPLAY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The display controler.
/// Displays a given view.

$viewDirectory = __DIR__ . '/../View';
$bodyDirectory = "$viewDirectory/Body";
$elementDirectory = "$viewDirectory/Element";

switch ($page) {
    case 'login' :
        // declare needed variables
        break;
    case 'register' :
        // declare needed variables
        break;
    case 'posts' :
        // declare needed variables
        break;
    case 'categories' :
        // declare needed variables
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        require  "$bodyDirectory/notFound.php";
        return;
}

require "$viewDirectory/head.php";
require "$bodyDirectory/$page.php";
require "$elementDirectory/header.php";
require "$elementDirectory/footer.php";

return;