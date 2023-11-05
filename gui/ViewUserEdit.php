<?php

namespace gui;

class ViewUserEdit extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Edition de profil';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->show('userEdit');
    }
}