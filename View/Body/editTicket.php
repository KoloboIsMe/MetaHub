<?php
function showEditTicket()
{
    $post = $outputData->getOutputData();
    $id = $post->getTicket()->getTicket_ID();
    $title = $post->getTicket()->getTitle();
    return "
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='/index.php?action=editTicketAction&id=$id' method='POST'>
                <h1>Edition</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre du post \" name='title' value=\"" . htmlspecialchars($title, ENT_QUOTES) . "\" required></input>
        
                <label><b>Contenu du post</b></label>
                <textarea placeholder='Entrer le contenu du post' name='message' required>" . $post->getTicket()->getMessage() . "</textarea>
        
                <input type='submit' id='submit' value='Enregistrer' >
            </form>
        </div>
        ";

}