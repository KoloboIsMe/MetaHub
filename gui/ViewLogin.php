<?php

namespace gui;

class ViewLogin extends View
{
    public function __construct($layout, $page)
    {
        parent::__construct($layout);

        $this->title = 'Connexion';

        $page ? $action = '/' . $_GET['url'] . '?action=login_verification&id=' . $page : $action = '/' . $_GET['url'] . '?action=login_verification';

        $this->content = "
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action=$action method='POST'>
                <h1>Login</h1>
        
                <label><b>Nom d'utilisateur</b></label>
                <input type='text' placeholder=\" Entrer le nom d'utilisateur \" name='username' required>
        
                <label><b>Mot de passe</b></label>
                <input type='password' placeholder='Entrer le mot de passe' name='password' required>
        
                <input type='submit' id='submit' value='LOGIN' >
           
            <p>vous n'avez pas de compte ? <a href='/register'>inscrivez-vous</a></p>
            </form>
        </div>
        ";
    }
}