<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  SINGLETONS  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Instantiates all Singletons.

$categoryDatabase = new Frameword\Database\Table\CategoryTable($dbLector);
$commentDatabase = new Frameword\Database\Table\CommentTable($dbLector);
$ticketDatabase = new Frameword\Database\Table\TicketTable($dbLector);
$userDatabase = new Frameword\Database\Table\UserTable($dbLector);
$accessorsLectors = array(
    'categoryAccessLector' => $categoryDatabase,
    'ticketAccessLector' => $ticketDatabase,
    'commentAccessLector' => $commentDatabase,
    'userAccessLector' =>$userDatabase
);

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
