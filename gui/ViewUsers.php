<?php

namespace gui;

class ViewUsers extends View
{
    public function __construct($layout, $presenter, $user)
    {
        parent::__construct($layout);

        $this->title = 'Users';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];


        isset($_GET['id']) ? $this->content=$presenter->showUser($user) : $this->content=$presenter->showUsers();
    }
}