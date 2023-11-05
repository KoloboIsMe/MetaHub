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

        $this->searchBar = true;

        isset($_GET['id']) ? $this->content = $presenter->show('post') : $this->content = $presenter->show('posts');
    }
}