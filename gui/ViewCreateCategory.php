<?php

namespace gui;

class ViewCreateCategory extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Creation de catégorie';

        $this->content = "
        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        <div id='container'>
            <form action='?action=createCategoryAction' method='POST'>
                <h1>Creation de catégorie</h1>
        
                <label><b>Titre</b></label>
                <input type='text' placeholder=\" Entrer le titre \" name='label' required>
        
                <label><b>Description</b></label>
                <input type='text' placeholder='Entrer la description' name='description' required>
        
                <input type='submit' id='submit' value='ENREGISTRER' >
            </form>
        </div>
        ";
    }
}