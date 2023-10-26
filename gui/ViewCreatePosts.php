<?php

namespace gui;

class ViewCreatePosts extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Création de post';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = "
        <script src='gui/js/scriptmoi.js'></script>
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='creationPost' method='POST' id='myForm'>
                    <h1>Login</h1>
  
                    <label><b>Titre du Post</b></label>
                    <input type='text' placeholder=\" Entrer le titre du Post \" name='title' required>
            
                    <label><b>Contenu du Post</b></label>
                    <input type='text' placeholder='Entrer le contenu du Post' name='content' required>
                    
                    <label for='categorie'>Catégorie :</label>
                    <select id='categorie' name='categorie'>
                      <option value='option1'>Option 1</option>
                      <option value='option2'>Option 2</option>
                      <option value='option3'>Option 3</option>
                    </select>
                    <button type='button' id='ajouterMot'>Ajouter le mot</button>
                    
                    <ul id='listeMots'></ul>
                    <input type='hidden' id='mots' name='mots'>
           
                    <input type='submit' id='submit' value='publier' >
            </form>
        </div>
        
        ";
    }
}