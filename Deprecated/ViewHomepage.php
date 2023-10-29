<?php

namespace Deprecated;

use gui\View;

class ViewHomepage extends View
{
    public function __construct($layout)
    {
        parent(__construct($layout));
        $this->title = 'Accueil';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = '<h1>Accueil</h1>';
    }
}