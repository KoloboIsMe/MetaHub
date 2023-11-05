<?php
if(!isset($users))
{
    return;
}
?>
<h2>Utilisateurs</h2>
<div class='card-container'>
    <?php foreach ($users as $user) {
        $id = $user['id'];
        $username = $user['username'];
        echo "
    <a href='users&id=$id'>
        <div class='post-header'>
            <img src='gui/images/user.png' id='usersImg'>
            <p id='username-list'>@ $username</p>
        </div>
    </a> ";} ?>
</div>