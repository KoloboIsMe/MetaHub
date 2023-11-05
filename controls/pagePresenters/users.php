<h2>Utilisateurs</h2>
<div class='card-container'>
    <?php foreach ($this->outputData->getOutputData() as $user) {
    $id = $user->getUser_ID();?>
    <a href='users&id=<?=$id?>'>
        <div class='post-header'>
            <img src='gui/images/user.png' id='usersImg'>
            <p id='username-list'>@<?= $user->getUsername()?></p>
            <?php if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {?>
                <a href='ouais'><button ><img src='gui/images/delete.png' id='add-button'></button></a>
            <?php }?>
        </div>
    </a>
    <?php } ?>
</div>