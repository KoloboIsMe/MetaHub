<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  FUNCTIONS  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// All the controller functions.
function getCompleteTickets($outputData, $accessors, $dataGetting){
    $dataGetting['commentsGetting']->resetOutputDataComments();
    $dataGetting['usersGetting']->resetOutputDataUsers();
    $dataGetting['categoriesGetting']->resetOutputDataCategories();

    $dataGetting['ticketsGetting']->getTickets($accessors['ticketAccessLector']);
    foreach ($outputData->getOutputDataTickets() as $ticket) {
        $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
        $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
        $dataGetting['categoriesGetting']->addCategoriesWithTicket($accessors['categoryAccessLector'], $ticket->getTicket_ID());
    }
}

function getCompleteTicketsById($outputData, $accessors, $dataGetting, $id){
    $dataGetting['commentsGetting']->resetOutputDataComments();
    $dataGetting['usersGetting']->resetOutputDataUsers();
    $dataGetting['categoriesGetting']->resetOutputDataCategories();
    $dataGetting['ticketsGetting']->resetOutputDataTickets();

    $dataGetting['ticketsGetting']->getTicketById($accessors['ticketAccessLector'], $id);
    $ticket = $outputData->getOutputDataTickets()[0];
    $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
    $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
    $dataGetting['categoriesGetting']->addCategoriesWithTicket($accessors['categoryAccessLector'], $ticket->getTicket_ID());
}

function getTicketByCatgories($outputData, $accessors, $dataGetting){
    $dataGetting['commentsGetting']->resetOutputDataComments();
    $dataGetting['usersGetting']->resetOutputDataUsers();
    $dataGetting['categoriesGetting']->resetOutputDataCategories();
    $dataGetting['ticketsGetting']->resetOutputDataTickets();

    $dataGetting['categoriesGetting']->getCategories($accessors['categoryAccessLector']);
    foreach ($outputData->getOutputDataCategories() as $category) {
        $dataGetting['ticketsGetting']->addTicketsWithCategory($accessors['ticketAccessLector'], $category->getCategory_ID());
        foreach ($outputData->getOutputDataTickets($category->getCategory_ID()) as $ticket) {
            $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
            $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
        }
    }
}

function getTicketByCatgoriesById($outputData, $accessors, $dataGetting, $id){
    $dataGetting['commentsGetting']->resetOutputDataComments();
    $dataGetting['usersGetting']->resetOutputDataUsers();
    $dataGetting['categoriesGetting']->resetOutputDataCategories();
    $dataGetting['ticketsGetting']->resetOutputDataTickets();

    $dataGetting['categoriesGetting']->getCategoryById($accessors['categoryAccessLector'], $id);
    $category = $outputData->getOutputDataCategories()[0];
    $dataGetting['ticketsGetting']->addTicketsWithCategory($accessors['ticketAccessLector'], $category->getCategory_ID());
    foreach ($outputData->getOutputDataTickets($category->getCategory_ID()) as $ticket) {
        $dataGetting['commentsGetting']->addCommentsByTicketId($accessors['commentAccessLector'], $ticket->getTicket_ID());
        $dataGetting['usersGetting']->addUserById($accessors['userAccessLector'], $ticket->getAuthor());
    }
}

function authentificateAction($outputData, $usersGetting, $data)
{
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $usersGetting->authentificate($_POST['username'], $_POST['password'], $data);
        if (!$outputData->getOutputDataUsers()) {
            return 'Mauvais identifiant ou mot de passe !';
        }
        $_SESSION['isLogged'] = true;
        $_SESSION['username'] = $_POST['username'];
    } else {
        return 'Veuillez remplir tous les champs !';
    }
}

function registerAction($outputData, $usersGetting, $data)
{
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            return 'Les mots de passe ne correspondent pas !';
        }
        return $usersGetting->register($_POST['username'], $_POST['password'], $data);
    } else {
        return 'Veuillez remplir tous les champs !';
    }
}
function showCompleteTickets($outputData, $id = 0)
{
    $content = '';
    foreach ($outputData->getOutputDataTickets($id) as $ticket) {
        $id = $ticket->getTicket_ID();
        $content .= "
            <div class='card-container1'>
                <a href='posts&id=$id'>
                <div class='card'>
                    <div class='card-content'>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p></a>";

        foreach ($outputData->getOutputDataComments($id) as $comment) {
            if ($comment->getTicket() == $id)
                $content .= "
                        <p>" . $comment->getText() . "</p>";
        }

        foreach ($outputData->getOutputDataCategories($id) as $category) {
            $content .= "
                        <p>#" . $category->getLabel() . "</p>";
        }
        $user = $outputData->getOutputDataUsers($ticket->getAuthor());
        $content .= "
                        <p>" . $user->getUsername() . "</p>
                    </div>
                </div>";
    }
    $content .= "
            </div>";
    return $content;
}

function showCategoriesTickets($outputData)
{
    $content = '';
    foreach ($outputData->getOutputDataCategories() as $category) {
        $id = $category->getCategory_ID();
        $content .= "
            <div class='card-container1'>
                <a href='categories&id=$id'><h1>" . $category->getLabel() . "</h1></a>";
        foreach ($outputData->getOutputDataTickets($id) as $ticket) {
            $id = $ticket->getTicket_ID();
            $content .= "
                <div class='card'>
                    <div class='card-content'>
                        <h1>" . $category->getLabel() . "</h1>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p>";

            foreach ($outputData->getOutputDataComments($id) as $comment) {
                if ($comment->getTicket() == $id)
                    $content .= "
                        <p>" . $comment->getText() . "</p>";
            }
            $user = $outputData->getOutputDataUsers($ticket->getAuthor());
            $content .= "
                        <p>" . $user->getUsername() . "</p>
                    </div>
                </div>";
        }
        $content .= "
            </div>";
    }
    return $content;
}