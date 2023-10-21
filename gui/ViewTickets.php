<?php

namespace gui;

class ViewTickets extends View
{
    public function __construct($layout, $presenter )
    {
        parent::__construct($layout);

        $this->title = 'Tickets';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->showCompleteTickets();
    }
}