<?php

namespace controls;

class Controller
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticateAction($usersGetting, $userAccessLector)
    {

        $usersGetting->authenticate($_POST['username'], $_POST['password'], $userAccessLector);
        if (!$this->outputData->getOutputData()) {
            return 'Mauvais identifiant ou mot de passe !';
        }
        $_SESSION['isLogged'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['user_ID'] =  $usersGetting->getUserByUsername($userAccessLector, $_POST['username'])->getUser_ID();

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
        $categories = $_POST["categories"] ?? null;
        $ticketsGetting->createTicket($ticketAccess, $_POST["title"], $_POST["message"]);
    }






}