<?php

namespace gui;

class ViewPosts extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Tickets';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        isset($_GET['id']) ? $this->content = $presenter->showPost() : $this->content = $presenter->showPosts();
    }
}