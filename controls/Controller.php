<?php

namespace controls;

class Controller
{
    private $outputData;
    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
    public function authenticateAction($usersGetting, $userAccess)
    {
        $usersGetting->authenticate($_POST['username'], $_POST['password'], $userAccess);
        if (!$this->outputData->getOutputData()) {
            return 'Mauvais identifiant ou mot de passe !';
        }
        $_SESSION['isLogged'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['user_ID'] = $usersGetting->getUserByUsername($userAccess, $_POST['username'])->getUser_ID();
        $usersGetting->updateLastConnexion($userAccess, $_SESSION['user_ID']);
        return null;
    }

    public function registerAction($usersGetting, $userAccess)
    {
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            return 'Les mots de passe ne correspondent pas !';
        }
        return $usersGetting->register($_POST['username'], $_POST['password'], $userAccess);
    }

    public function createTicketAction($ticketsGetting, $ticketAccess)
    {
        $ticketID = $ticketsGetting->createTicket($ticketAccess, $_POST["title"], $_POST["message"]);
        if(isset($_POST["categories"])){
            $ticketsGetting->addCategoriesToTicket($ticketAccess, $_POST["categories"], $ticketID);
        }
    }


}