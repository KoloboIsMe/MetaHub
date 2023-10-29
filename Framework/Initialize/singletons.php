<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  SINGLETONS  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Instantiates all Singletons.

$categoryDatabase = new \Framework\database\CategoryDatabase($dbLector);
$commentDatabase = new \Framework\database\CommentDatabase($dbLector);
$ticketDatabase = new \Framework\database\TicketDatabase($dbLector);
$userDatabase = new \Framework\database\UserDatabase($dbLector);
$accessorsLectors = array(
    'categoryAccessLector' => $categoryDatabase,
    'ticketAccessLector' => $ticketDatabase,
    'commentAccessLector' => $commentDatabase,
    'userAccessLector' =>$userDatabase
);
$userAccess = new \Framework\database\UserDatabase($dbAdmin);

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new Deprecated\OutputData();

// initialisation du controller avec accès a la structure pour le transfert des données
$controller = new Deprecated\Controller($outputData);

// initialisation du presenter avec accès a la structure pour le transfert des données
$presenter = new Deprecated\Presenter($outputData);

//initialisation des services avec la structure pour le transfert des données
$categoriesGetting = new service\CategoriesGetting($outputData);
$ticketsGetting = new service\TicketsGetting($outputData);
$commentsGetting = new service\CommentsGetting($outputData);
$usersGetting = new service\UsersGetting($outputData);
$dataGetting = array('categoriesGetting' => $categoriesGetting, 'ticketsGetting' => $ticketsGetting, 'commentsGetting' =>$commentsGetting, 'usersGetting' =>$usersGetting);
