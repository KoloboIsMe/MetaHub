<link href="gui/css/posts.css" rel="stylesheet" type="text/css"/>
<h2>Posts</h2>
<div class='card-container'>
    <?php foreach ($data as $post) {
        $id = $post->getTicket()->getTicket_ID();?>
        <div class='post-card'>
            <a href='posts&id=<?=$id?>'>
            <div class='card-content'>
                <div class='post-header'>
                    <img src='gui/images/user.png' id='userImg'>
                    <p id='card-username'>@<?= $post->getUser()->getUsername()?></p>
                </div>
                <h3> <?= $post->getTicket()->getTitle() ?></h3>
                <div class="categories">
                    <?php foreach ($post->getCategories() as $category) { ?>
                        <div class='category'>#<?= $category->getLabel() ?></div>
                    <?php } ?>
                </div>
                <p> <?= $post->getTicket()->getMessage() ?></p>
                <time id='time'>Publié le <?= $post->getTicket()->getDate() ?></time>
                <p id='post-number'>Post n° <?= $post->getTicket()->getTicket_ID() ?></p>

                <?php if ((isset($_SESSION['level']) && $_SESSION['level'] > 0) || (isset($_SESSION['level']) && $_SESSION['user_ID'] == $post->getUser()->getUser_ID())) { ?>
                <div class='edit-delete'>
                    <a href='editTicket&id=<?=$id?>'><img src='gui/images/edit.png' id='editImg'></a>
                    <a href='?action=deleteTicketAction&id=<?=$id?>'><img src='gui/images/delete.png' id='deleteImg'></a>
                </div>
                <?php } ?>
            </div>
            </a>
        </div>
    <?php } ?>
</div>