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


        isset($_GET['id']) ? $this->content = $presenter->showCategorie($category) : $this->content = $presenter->showCategories();
    }
}