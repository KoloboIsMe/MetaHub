<?php

namespace gui;

class ViewHomepage extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);
        $this->title = 'Accueil';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->showHomepage();
    }
}





