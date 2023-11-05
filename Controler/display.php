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
$admin = FALSE;
if (empty($_SESSION['username']))
{
    $username = '';
}
else
{
    $username = $_SESSION['username'];
}

require "$elementDirectory/head.php";
require "$elementDirectory/header.php";

//TODO : If isset $error, show it

switch ($page) {
    case 'homepage' :
        require 'Connector/homepage.php';
        break;
    case 'login' :
        $action = '/index.php';
        require __DIR__ . '/../View/Body/login.php';
        break;
    case 'register' :
        require __DIR__ . '/../View/Body/register.php';
        break;
    case 'categories' :
        break;
    case 'createTicket' :
        break;
    case 'editTicket' :
        break;
    case 'error' :
        break;
    case 'users' :
        break;
    case 'posts' :
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        require  "$bodyDirectory/notFound.php";
        break;
}
require "$elementDirectory/footer.php";
return;