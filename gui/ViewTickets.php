<?php

namespace gui;

class ViewTickets extends View
{
    public function __construct($layout, $presenter )
    {
        parent::__construct($layout);

        $this->title = 'Tickets';

        $this->content = $presenter->showAllTickets();
    }
}