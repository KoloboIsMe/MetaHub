<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////// INITIALIZATION FILE /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Load all classes and instantiates every Singleton

// DECLARE CONSTANTS
const INI_FILE_PATH = 'config.ini';
const DATABASES = 'metahub_login';


// LOAD CLASSES
require 'Controler/Controller.php';
require 'Controler/Presenter.php';

require 'Framework/Database/CategoryAccess.php';
require 'Framework/Database/CommentAccess.php';
require 'Framework/Database/SPDO.php';
require 'Framework/Database/TicketAccess.php';
require 'Framework/Database/UserAccess.php';

require 'Framework/Entity/Category.php';
require 'Framework/Entity/Comment.php';
require 'Framework/Entity/Ticket.php';
require 'Framework/Entity/User.php';

require 'View/Layout.php';
require 'View/View.php';
require 'View/ViewCategories.php';
require 'View/ViewError.php';
require 'View/ViewHomepage.php';
require 'View/ViewLogin.php';
require 'View/ViewRegister.php';
require 'View/ViewTickets.php';

require 'Model/CategoriesGetting.php';
require "Model/CommentsGetting.php";
require "Model/OutputData.php";
require "Model/TicketsGetting.php";
require "Model/UsersGetting.php";

// INITIATE CONNEXION WITH REMOTE DATABASE
try {
    $dbAdmin = \Framework\database\Connexion::getInstance("serveur_admin");
    $dbLector = \Framework\database\Connexion::getInstance("serveur_lecture");
} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

// INSTANCIATE SINGLETONS
$categoryAccessLector = new \Framework\database\CategoryDatabase($dbLector);
$commentAccessLector = new \Framework\database\CommentDatabase($dbLector);
$ticketAccessLector = new \Framework\database\TicketDatabase($dbLector);
$userAccessLector = new \Framework\database\UserDatabase($dbLector);
$accessorsLectors = array(
    'categoryAccessLector' => $categoryAccessLector,
    'ticketAccessLector' => $ticketAccessLector,
    'commentAccessLector' => $commentAccessLector,
    'userAccessLector' =>$userAccessLector
);
$userAccess = new \Framework\database\UserDatabase($dbAdmin);

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new Deprecated\OutputData();

// initialisation du controller avec accès a la structure pour le transfert des données
$controller = new Controler\Controller($outputData);

// initialisation du presenter avec accès a la structure pour le transfert des données
$presenter = new Controler\Presenter($outputData);

//initialisation des services avec la structure pour le transfert des données
$categoriesGetting = new service\CategoriesGetting($outputData);
$ticketsGetting = new service\TicketsGetting($outputData);
$commentsGetting = new service\CommentsGetting($outputData);
$usersGetting = new service\UsersGetting($outputData);
$dataGetting = array('categoriesGetting' => $categoriesGetting, 'ticketsGetting' => $ticketsGetting, 'commentsGetting' =>$commentsGetting, 'usersGetting' =>$usersGetting);
