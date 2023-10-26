<?php

namespace gui;

class ViewCreatePosts extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Création de post';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];
//        <link href='gui/css/forms.css' rel='stylesheet' type='text/css' />
        $this->content = $presenter->showCreateTicket();
    }
}