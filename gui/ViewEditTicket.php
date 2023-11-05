<?php

namespace gui;

class ViewEditTicket extends View
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'modification';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->show('editTicket');
    }
}