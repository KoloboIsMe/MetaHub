<link href="gui/css/post.css" rel="stylesheet" type="text/css"/>
<h2>Post</h2>
<?php $post = $data;
$id = $post->getTicket()->getTicket_ID(); ?>
<div class='card-container1'>
    <div class='card'>
        <a href='posts&id=<?= $id ?>'>
            <div class='card-content'>
                <div class='post-header'>
                    <img alt="" src='gui/images/user.png' id='userImg'>
                    <p id='card-username'>@<?= $post->getUser()->getUsername() ?></p>
                </div>
                <h3> <?= $post->getTicket()->getTitle() ?></h3>
                <div class="categories">
                    <?php foreach ($post->getCategories() as $category) { ?>
                        <div class='category'>#<?= $category->getLabel() ?></div>
                    <?php } ?>
                </div>
                <p><?= $post->getTicket()->getMessage() ?></p>
                <time id='time'><B>Publié le <?= $post->getTicket()->getDate() ?></B></time>
                <p id='post-number'>Post n° <?= $post->getTicket()->getTicket_ID() ?></p>
                <?php if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())) { ?>
                    <div class="edit-delete">
                        <a href='editTicket&id=<?= $id ?>'><button ><img alt="" src='gui/images/edit.png' id='editImg'></button></a>
                        <a href='?action=deleteTicketAction&id=<?= $id ?>'><button ><img alt="" src='gui/images/delete.png' id='deleteImg'></button></a>
                    </div>
                <?php } ?>
            </div>
        </a>
    </div>
    <div class='comment-card'>
        <div class='card-content'>
            <form action='posts?action=createComment&id=<?=$id?>' method='POST'>
            <h3 id='comment'>Commentaires</h3>
            <div class='input-box'>
                <input type='text' class='input' placeholder='Ajoutez un commentaire' name='text'  required></input>
            </div>
            <input type='submit' class='btn' value='Ajouter'>
            </form>
        </div>
        <?php foreach ($post->getComments() as $comment) { ?>
        <div class='comment'>
            <img alt="" src='gui/images/user.png' id='user-comment-img'>
            <div class='comment-content'>  @<?= $comment->getAuthor_username() ?> : <?= $comment->getText() ?></div>
            <?php if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['user_ID']) && $_SESSION['user_ID'] == $comment->getAuthor())) { ?>
                <a href='?action=deleteCommentAction&id=<?=$comment->getComment_ID()?>'><button ><img alt="" src='gui/images/delete.png' id='deleteCommentImg'></button></a>
            <?php }?>
        </div>
        <?php } ?>
</div>

