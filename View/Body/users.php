<?php
function showUsers()
{
    $content = '';
    $content .= "<h2>Utilisateurs</h2>
                    <div class='card-container'>";
    foreach ($outputData->getOutputData() as $user) {
        $id = $user->getUser_ID();
        $content .= "
                        <a href='users&id=$id'>
                        <div class='post-header'>
                            <img src='gui/images/user.png' id='usersImg'>
                            <p id='username-list'>@ " . $user->getUsername() . "</p>
                        </div>
                        </a>";
    }
    $content .= "</div>";
    return $content;
}

function showUser($user)
{
    $content = '';
    $id = $user->getUser_ID();
    $content .= "
                    <a href='users&id=$id'>
                        <h2>@" . $user->getUsername() . "</h2>
                        <div class='card-container'>";

    foreach ($outputData->getOutputData() as $post) {
        $id = $post->getTicket()->getTicket_ID();
        $content .= "
                                <div class='post-card'>
                                    <a href='posts&id=$id'>
                                        <div class='card-content'>
                                            <h3> " . $post->getTicket()->getTitle() . "</h3>
                                            <p>" . $post->getTicket()->getMessage() . "</p>
                                            <time id='time'>" . $post->getTicket()->getDate() . " </time>
                                            <p>" . $post->getTicket()->getTicket_ID() . "</p>
                                        </div>
                                    </a>
                                </div>";
    }

    $content .= "</div>
                    </a>";
    return $content;
}