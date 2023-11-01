<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  SESSION  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Initiate a session.

ini_set('session.gc_maxlifetime', 3600); // One hour
session_set_cookie_params(3600);
session_start();

if ('registerAction' === $_GET['url'] && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->registerAction($usersGetting, $userAccess);
    if ($error){
        $url = 'register'; // change
    }else
        $url = 'login_verification'; // change
}
if ('login_verification' === $_GET['url'] && isset($_POST['username']) && isset($_POST['password'])) {

    $page = $_GET['id'] ?? $page = null;
    $error = $controller->authentificateAction($usersGetting, $userDatabase);
    if ($error){
        $page ? $redirect = 'login&id='.$page : $redirect = 'login';
        $url = 'error'; // change
    }else{
        $url = '/'; // change
        $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
    }
}