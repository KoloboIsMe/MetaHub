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
$logged = TRUE;
$admin = TRUE;
$username = $_SESSION['username'];
require "$elementDirectory/head.php";
echo "<body> \n";
require "$elementDirectory/header.php";

switch ($page) {
    case 'homepage' :
        require 'homepage.php';
        break;
    case 'login' :
        require 'login.php';
        break;
    case 'register' :
        require 'register.php';
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        require  "$bodyDirectory/notFound.php";
        break;
}
require "$elementDirectory/footer.php";
return;