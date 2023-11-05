<?php

namespace gui;

class ViewRegister extends View
{
    public function __construct($layout, $page, $error = '')
    {
        parent::__construct($layout);

        $this->title = 'Enregistrement';

        $page ? $action = '/'.$_GET['url'].'?action=registerAction&id=' . $page : $action = '/'.$_GET['url'].'?action=registerAction';

        $this->content = "
<link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
<div id='container'>
    <form action=$action method='POST' onsubmit=\"return validateForm()\">
        <h1>Register</h1>
    
        <label><b>Nom d'utilisateur</b></label>
        <input type='text' placeholder=\"Entrer le nom d'utilisateur\" name='username' id='username' required>
    
        <label><b>Mot de passe</b></label>
        <input type='password' id='password' placeholder='Entrer le mot de passe' name='password' required>
    
        <label><b>Confirmer mot de passe</b></label>
        <input type='password' id='password_confirmation' placeholder='Entrer le mot de passe' name='password_confirmation' required>
        <p id='password_confirmation_error'>$error</p>
    
        <input type='submit' id='submit' value='REGISTER'>
    
        <p>Vous avez déjà un compte ? <a href='/login'>Connectez-vous</a></p>
    </form>
</div>
<script>
    function validateForm() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var passwordConfirmation = document.getElementById('password_confirmation').value;
        var passwordConfirmationError = document.getElementById('password_confirmation_error');

        if (username === '' || password === '' || passwordConfirmation === '') {
            passwordConfirmationError.innerHTML = 'il faut remplir tous les champs';
            return false;
        }
        if (password !== passwordConfirmation) {
            passwordConfirmationError.innerHTML = 'Les mots de passe ne correspondent pas';
            return false;
        }

        return true;
    }
</script>

";
    }
}
