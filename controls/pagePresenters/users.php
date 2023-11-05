<link href="gui/css/users.css" rel="stylesheet" type="text/css"/>
<h2>Utilisateurs</h2>
<div class='card-container'>
    <?php foreach ($this->outputData->getOutputData() as $user) {
    $id = $user->getUser_ID();?>
    <div class="users-card">
        <a href='users&id=<?=$id?>'>
            <div class='post-header'>
                <img src='gui/images/user.png' id='usersImg'>
                <div class="delete-user">
                    <p id='username-list'>@<?= $user->getUsername()?></p>
                    <?php if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {?>
                        <a href='?action=deleteUserAction&id=<?=$id?>'><button ><img src='gui/images/delete.png' id='deleteUser'></button></a>
                    <?php }?>
                </div>
            </div>
        </a>
    </div>
    <?php } ?>
</div>