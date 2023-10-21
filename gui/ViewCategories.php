<?php

namespace gui;

class ViewCategories extends View
{
    public function __construct($layout, $presenter )
    {
        parent::__construct($layout);

        $this->title = 'Categories';

        $this->content = $presenter->showCategoriesTickets();
    }
}