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

    /**
     * @param $usersService
     * @param $userAccess
     * @return string|null
     */
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

    /**
     * @param $ticketsService
     * @param $ticketAccess
     * @param $categoryService
     * @param $categoriesAccess
     * @param $generalAccess
     * @return void
     */
    public function createTicketAction($ticketsService, $ticketAccess, $categoryService, $categoriesAccess, $generalAccess): void
    {
        $ticketID = $ticketsService->createTicket($ticketAccess, $_POST["title"], $_POST["message"]);
        if (isset($_POST["categories"])) {
            foreach ($_POST["categories"] as $category) {
                $generalAccess->addCategoryToTicket($categoryService->getCategoryIdByLabel($categoriesAccess, $category), $ticketID);
            }
        }
    }

    /**
     * @param $usersService
     * @param $userAccess
     * @return mixed|string
     */
    public function registerAction($usersService, $userAccess)
    {
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            return 'Les mots de passe ne correspondent pas !';
        }
        return $usersService->register($_POST['username'], $_POST['password'], $userAccess);
    }

    /**
     * @param $usersService
     * @param $userAccess
     * @return mixed|string
     */
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

    /**
     * @param $usersService
     * @param $userAccess
     * @param $generalAccess
     * @param $userid
     * @return string|null
     */
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

    /**
     * @param $ticketsService
     * @param $ticketAccess
     * @param $generalAccess
     * @param $ticketid
     * @return string|null
     */
    public function deleteTicket($ticketsService, $ticketAccess, $generalAccess, $ticketid): ?string
    {
        if ($ticketsService->isTicketOwner($ticketAccess, $ticketid, $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $generalAccess->deleteTicket($ticketid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer ce ticket !';
    }

    /**
     * @param $commentsService
     * @param $commentAccess
     * @param $commentid
     * @return string|null
     */
    public function deleteComment($commentsService, $commentAccess, $commentid): ?string
    {
        if ($commentsService->isCommentOwner($commentAccess, $commentid, $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $commentsService->deleteComment($commentAccess, $commentid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer ce commentaire !';
    }

    /**
     * @param $generalAccess
     * @param $categoryid
     * @return string|null
     */
    public function deleteCategory($generalAccess, $categoryid): ?string
    {
        if ($_SESSION['level'] > 0) {
            $generalAccess->deleteCategory($categoryid);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour supprimer cette catégorie !';
    }

    /**
     * @param $ticketsService
     * @param $ticketAccess
     * @return string|null
     */
    public function editTicket($ticketsService, $ticketAccess): ?string
    {
        if ($ticketsService->isTicketOwner($ticketAccess, $_GET['id'], $_SESSION['user_ID']) || $_SESSION['level'] > 0) {
            $ticketsService->editTicket($ticketAccess, $_GET['id'], $_POST["title"], $_POST["message"]);
            return null;
        } else
            return 'Vous n\'avez pas les droits pour modifier ce ticket !';
    }

    /**
     * @param $id
     * @param $generalAccessLector
     * @return void
     */
    public function getPostById($id, $generalAccessLector): void
    {
        $posts = $generalAccessLector->getPostById($id);
        $this->outputData->setOutputData($posts);
    }


}