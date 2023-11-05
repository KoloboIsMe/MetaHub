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
$admin = TRUE;
if (empty($_SESSION['username']))
{
    $username = '';
}
else
{
    $username = $_SESSION['username'];
}

require "$elementDirectory/head.php";
echo "<body> \n";
require "$elementDirectory/header.php";

switch ($page) {
    case 'homepage' :
        require 'Connector/homepage.php';
        break;
    case 'login' :
        require 'Connector/login.php';
        break;
    case 'register' :
        require 'Connector/register.php';
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        require  "$bodyDirectory/notFound.php";
        break;
}
require "$elementDirectory/footer.php";
return;