<?php

namespace Deprecated;

class ViewCategories extends View
{
    public function __construct($layout, $presenter )
    {
        parent::__construct($layout);

        $this->title = 'Categories';

        if(isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->content = $presenter->showCategoriesTickets();
    }
}