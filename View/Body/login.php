<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOGIN  //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The login view.
/// Called when the user tries to log in.
if (!isset($action))
{
    return;
}
?>

<link href='View/_assets/style/forms.css' rel='stylesheet' type='text/css' />
<div id='container'>
    <form action=<?php echo $action ?> method='POST'>
        <h1>Login</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input type='text' placeholder=\" Entrer le nom d'utilisateur \" name='username' required>

        <label><b>Mot de passe</b></label>
        <input type='password' placeholder='Entrer le mot de passe' name='password' required>

        <input type='submit' id='submit' value='LOGIN' >

        <input name="action" type="hidden" value="login" />


        <p>vous n'avez pas de compte ? <a href='/register'>inscrivez-vous</a></p>
    </form>
</div>