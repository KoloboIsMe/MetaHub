<?php

namespace gui;

class ViewCategories extends View
{
    public function __construct($layout, $presenter, $category)
    {
        parent::__construct($layout);

        $this->title = 'Categories';

        if (isset($_SESSION['username']))
            $this->username = $_SESSION['username'];

        $this->searchBar = true;

        isset($_GET['id']) ? $this->content = $presenter->showCategory($category) : $this->content = $presenter->show('categories');
    }
}