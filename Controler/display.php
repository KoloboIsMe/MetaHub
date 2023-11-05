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
echo "<body> \n";
require "$elementDirectory/header.php";

switch ($page) {
    case 'homepage' :
        require 'homepage.php';
        break;
    case 'login' :
        // declare needed variables
        $action = 'uneAction';
        break;
    case 'posts' :
        // declare needed variables
        break;
    case 'categories' :
        // declare needed variables
        break;
    case 'login' :
        $page = $_GET['id'] ?? $page = null;
        require '../Model/login.php';
        if (isset($error)){
            $page ? $redirect = 'login&id='.$page : $redirect = 'login';
            $url = 'error';
        }else{
            $url = '/';
            $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
        }
        break;
    case 'register' :
        $page = $_GET['id'] ?? $page = null;
        require '../Model/register.php';
        if (isset($error)){
            $url = 'register';
        }else
            $url = 'login_verification';
        break;
    default:
        // declare needed variables
        header('Status: 404 Not Found');
        require  "$bodyDirectory/notFound.php";
        break;
}
require "$elementDirectory/footer.php";
echo "</body> \n</html>";
return;