<?php $user = $data; ?>

<link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
<div id='container'>
    <form action='?action=editUserInfoAction' method='POST'>
        <h1>Edition de profil</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type='text' placeholder="Entrer le nom d'utilisateur" name='username' value="<?=htmlspecialchars($user->getusername(), ENT_QUOTES)?>" required></input>

        <label><b>ancien mot de passe</b></label>
        <input type="password" placeholder="Entrer l'ancien mot de passe" name='old_password' required />

        <label><b>nouveau mot de passe (optionnel)</b></label>
        <input type="password" placeholder='Entrer le mot de passe' name='password'/>

        <input type='submit' id='submit' value='Changer' >
        <a href="?action=deleteUserAction&id=<?=$user->getUser_id()?>"><label><b>supprimer le compte</b></label></a>
    </form>
</div>
