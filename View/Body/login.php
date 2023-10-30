<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOGIN  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The login view.
/// Called when the user tries to log in.
?>

<div id='container'>
    <form action=<?php $action ?> ../../index.php>
        <h1>Login</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type='text' placeholder=\" Entrer le nom d'utilisateur \" name='username' required>

        <label><b>Mot de passe</b></label>
        <input type='password' placeholder='Entrer le mot de passe' name='password' required>

        <input type='submit' id='submit' value='LOGIN' >

        <p>vous n'avez pas de compte ? <a href='../../index.php'>inscrivez-vous</a></p>
    </form>
</div>
