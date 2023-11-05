<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  POSTS  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The posts view.
/// Show the ticket lists.

function showPost()
{
$content = '';
$content .= "<h2>Post</h2>
";
$post = $outputData->getOutputData();
$id = $post->getTicket()->getTicket_ID();
$content .= "<div class='card-container1'>
    ";
    $content .= "
    <div class='card'>
        <a href='posts&id=$id'>
            <div class='card-content'>
                <div class='post-header'>
                    <img src='gui/images/user.png' id='userImg'>
                    <p id='card-username'>@" . $post->getUser()->getUsername() . "</p>
                </div>
                <h3> " . $post->getTicket()->getTitle() . "</h3>
                <p>" . $post->getTicket()->getMessage() . "</p>
                <time id='time'><B>Publié le " . $post->getTicket()->getDate() . "</B> </time>
                <p id='post-number'>Post n° " . $post->getTicket()->getTicket_ID() . "</p>";
                foreach ($post->getCategories() as $category) {
                $content .= "<p id='category'>#" . $category->getLabel() . "</p>";
                }
                $content .= "
            </div>
        </a>
    </div>
    <div class='comment-card'>
        <div class='card-content'>
            <form action='".$_GET['url']."?action=createComment&id=$id' method='POST'>
            <h3 id='comment'>Commentaires</h3>
            <div class='input-box'>
                <input type='text' class='input' placeholder='Ajoutez un commentaire' name='text'  required></input>
            </div>
            <input type='submit' class='btn' value='Ajouter'>
            </form>
        </div>";

        foreach ($post->getComments() as $comment) {
        $content .= "<div class='comment'><img src='gui/images/user.png' id='user-comment-img'><div class='comment-content'>  @" . $comment->getAuthor_username() . " : " . $comment->getText() . "</div></div>";
        }

        $content .= "</div>";

    return $content;
    }
function showPosts()
{
    $content = '';
    $content .= "<h2>Posts</h2>
    <div class='card-container'>";
    foreach ($outputData->getOutputData() as $post) {
        $id = $post->getTicket()->getTicket_ID();
        $content .= "
        <div class='post-card'>
            <a href='posts&id=$id'>
                <div class='card-content'>
                    <div class='post-header'>
                        <img src='gui/images/user.png' id='userImg'>
                        <p id='card-username'>@" . $post->getUser()->getUsername() . "</p>
                    </div>
                    <h3> " . $post->getTicket()->getTitle() . "</h3>
                    <p>" . $post->getTicket()->getMessage() . "</p>
                    <time id='time'><B>Publié le " . $post->getTicket()->getDate() . "</B> </time>
                    <p id='post-number'>Post n° " . $post->getTicket()->getTicket_ID() . "</p>";

        if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())){
            $content .= "<div class='edit-delete'>
                        <a href='editTicket&id=$id'><img src='gui/images/edit.png' id='editImg'></a>
                        <a href='/index.php?action=deleteTicketAction&id=$id'><img src='gui/images/delete.png' id='deleteImg'></a>
                    </div>";
        }

        $content .="</div></a>
        </div>
        ";
    }
    $content .= "</div>";
    return $content;
}