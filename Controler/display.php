<?php
///////////////////////////////////////////////////////////////////////////////
//////////////////////////////  DISPLAY  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The display controler.
/// Displays a given view.

$viewDirectory = __DIR__ . '/../View';
$bodyDirectory = "$viewDirectory/Body";
$elementDirectory = "$viewDirectory/Element";

if (!isset($page))
{
    return;
}

$title = $page;
require "$elementDirectory/head.php";
echo '<body>';
require "$elementDirectory/header.php";

switch ($page) {
    case 'homepage' :
        require 'homepage.php';
        break;
    case 'login' :
        // declare needed variables
        $action = 'uneAction';
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
require "$elementDirectory/footer.php";
echo '</body>';
echo '</html>';


return;