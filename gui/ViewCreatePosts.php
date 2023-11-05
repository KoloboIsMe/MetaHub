<?php

namespace gui;

class ViewCreatePosts extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Création de post';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->show('createTicket');
    }
}