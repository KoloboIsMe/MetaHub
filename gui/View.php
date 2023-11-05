<?php

namespace gui;
abstract class View
{
    protected $title = '';
    protected $content = '';

    protected $username = '';
    protected $searchBar = null;
    protected $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    public function display()
    {
        $this->layout->display($this->title, $this->content, $this->username, $this->searchBar);
    }
}