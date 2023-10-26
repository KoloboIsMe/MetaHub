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

    }

    public function registerAction($usersGetting, $data)
    {
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            return 'Les mots de passe ne correspondent pas !';
        }
        return $usersGetting->register($_POST['username'], $_POST['password'], $data);
    }






}