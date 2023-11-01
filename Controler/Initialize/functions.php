<?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////// functionS  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// All the controllerfunctions.

function authenticateAction($usersGetting, $userAccessLector)
{

    $usersGetting->authenticate($_POST['username'], $_POST['password'], $userAccessLector);
    if (!$outputData->getOutputData()) {
        return 'Mauvais identifiant ou mot de passe !';
    }
    $_SESSION['isLogged'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['user_ID'] =  $usersGetting->getUserByUsername($userAccessLector, $_POST['username'])->getUser_ID();

}

function registerAction($usersGetting, $userAccess)
{
    if ($_POST['password'] !== $_POST['password_confirmation']) {
        return 'Les mots de passe ne correspondent pas !';
    }
    return $usersGetting->register($_POST['username'], $_POST['password'], $userAccess);
}

function createTicketAction($ticketsGetting, $ticketAccess)
{
    $categories = $_POST["categories"] ?? null;
    $ticketsGetting->createTicket($ticketAccess, $_POST["title"], $_POST["message"]);
}

function showCategories()
{
    $content = '';
    foreach ($outputData->getOutputData() as $category) {
        $id = $category->getCategory_ID();
        $content .= "
                <div class='card'>
                    <a href='categories&id=$id'>
                    <div class='card-content'>
                        <h3> " . $category->getLabel() . "</h3>
                        <p>" . $category->getDescription() . "</p>
                    </div></a>
                </div>";
    }
    return $content;
}

function showCategorie($category){
    $content = '';
    $id = $category->getCategory_ID();
    $content .= "
                <div class='card'>
                    <a href='categories&id=$id'>
                    <div class='card-content'>
                        <h3>".$category->getLabel()."</h3>
                        <p>".$category->getDescription()."</p>";

    foreach ($outputData->getOutputData() as $post) {
        $id = $post->getTicket()->getTicket_ID();
        $content .= "
                                <div class='card'>
                                    <a href='posts&id=$id'>
                                    <div class='card-content'>
                                        <p>" . $post->getUser()->getUsername() . "</p>
                                        <h3> " . $post->getTicket()->getTitle() . "</h3>
                                        <p>" . $post->getTicket()->getMessage() . "</p>
                                        <time>" . $post->getTicket()->getDate() . " </time>
                                        <p>" . $post->getTicket()->getTicket_ID() . "</p>
                                    </div></a>
                                </div>";
    }

    $content .= "
                    </div></a>
                </div>";
    return $content;
}

function showCreateTicket(){
    $content = "
        <script src='https://unpkg.com/slim-select@latest/dist/slimselect.min.js'></script>
        <link href='gui/css/CategorySelectionBar.css' rel='stylesheet'></link>
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action=createPostsAction method='POST'>
                <h1>Nouveau Post</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre du post \" name='title' required>
        
                <label><b>Contenu du post</b></label>
                <textarea placeholder='Entrer le contenu du post' name='message' required></textarea>
        
                <select id='category' multiple name='categories[]'>";
    foreach ($outputData->getOutputData() as $category) {
        $content .= "<option>".$category->getLabel()."</option>";
    }
    $content .= "        
                </select>
                <input type='submit' id='submit' value='Publier' >
            </form>
        </div>
        
        <script>
            new SlimSelect({
                select: '#category',
                settings: {
                    placeholderText: 'Choisir une catégorie',
                    searchPlaceholder: 'Rechercher',
                }
            })
        </script>
        ";

    return $content;
}