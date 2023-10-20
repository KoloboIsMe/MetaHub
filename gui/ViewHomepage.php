<?php

namespace gui;

class ViewHomepage extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->title = 'Accueil';

        $this->content = '<h1>Accueil</h1>';
    }
}