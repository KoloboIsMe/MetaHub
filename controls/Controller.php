<?php

namespace controls;

use database\GeneralAccess;

class Controller
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticateAction($usersService, $userAccess): ?string
    {
        $usersService->authenticate($_POST['username'], $_POST['password'], $userAccess);
        if (!$this->outputData->getOutputData()) {
            return 'Mauvais identifiant ou mot de passe !';
        }
        $user = $usersService->getUserByUsername($userAccess, $_POST['username']);
        $_SESSION['isLogged'] = true;
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['user_ID'] = $user->getUser_ID();
        $_SESSION['level'] = $user->getLevel();
        $usersService->updateLastConnexion($userAccess, $_SESSION['user_ID']);
        return null;
    }
    public function createTicketAction($ticketsService, $ticketAccess, $categoryService,$categoriesAccess, $generalAccess): void
    {
        $ticketID = $ticketsService->createTicket($ticketAccess, $_POST["title"], $_POST["message"]);
        if (isset($_POST["categories"])) {
            foreach ($_POST["categories"] as $category) {
                $generalAccess->addCategoryToTicket($categoryService->getCategoryIdByLabel($categoriesAccess, $category), $ticketID);
            }
        }
    }
    public function registerAction($usersService, $userAccess)
    {
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            return 'Les mots de passe ne correspondent pas !';
        }
        return $usersService->register($_POST['username'], $_POST['password'], $userAccess);
    }
    public function updateUserAction($usersService, $userAccess)
    {
        if ($usersService->existsUsername($userAccess, $_POST['username']) && $_POST['username'] !== $_SESSION['username'])
            return "nom d'utilisateur déja pris";
        if (password_verify($_POST['old_password'], $usersService->getUserById($userAccess, $_SESSION['user_ID'])->getPassword())) {
            isset($_POST['password']) ? $newPassword = $_POST['password'] : $newPassword = $_POST['old_password'];
            return $error = $usersService->updateUser($_POST['username'], $newPassword, $userAccess);
        } else
            return "mot de passe incorrect";
    }

    public function deleteUser($usersService, $userAccess, $generalAccess, $userid): ?string
    {
        if ($usersService->existsUser($userAccess, $userid) && ($_SESSION['level'] > 0 || $userid == $_SESSION['user_ID'])) {
            foreach ($generalAccess->getTicketsIdByUserId($userid) as $ticketID) {
                $generalAccess->deleteTicket($ticketID);
            }
            foreach ($generalAccess->getCommentsIdByUserId($userid) as $commentID) {
                $generalAccess->deleteComment($commentID);
            }
            $generalAccess->deleteUser($userid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer cet utilisateur !';
    }
    public function deleteTicket($ticketsService, $ticketAccess, $generalAccess, $ticketid): ?string
    {
        if ($ticketsService->isTicketOwner($ticketAccess, $ticketid, $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $generalAccess->deleteTicket($ticketid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer ce ticket !';
    }
    public function deleteComment($commentsService, $commentAccess, $generalAccess, $commentid): ?string
    {
        if ($commentsService->isCommentOwner($commentAccess, $commentid, $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $generalAccess->deleteComment($commentid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer ce commentaire !';
    }
    public function deleteCategory($generalAccess, $categoryid): ?string
    {
        if ($_SESSION['level'] > 0) {
            $generalAccess->deleteCategory($categoryid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer cette catégorie !';
    }

    public function editTicket($ticketsService, $ticketAccess): ?string
    {
        if ($ticketsService->isTicketOwner($ticketAccess, $_GET['id'], $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $ticketsService->editTicket($ticketAccess, $_GET['id'], $_POST["title"], $_POST["message"]);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour modifier ce ticket !';
    }
    public function getPostById($id, $generalAccessLector): void
    {
        $posts = $generalAccessLector->getPostById($id);
        $this->outputData->setOutputData($posts);
    }


}