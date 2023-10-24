<?php

namespace gui;

class ViewCreatePosts extends View
{

    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Création de post';

        $this->content = file_get_contents('gui/ViewCreatePosts.html');
    }
}