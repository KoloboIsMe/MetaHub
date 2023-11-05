<?php

namespace gui;
class Layout
{
    protected $templateFile;

    public function __construct($templateFile)
    {
        $this->templateFile = $templateFile;
    }

    public function display($title, $content, $username, $searchBar = null)
    {
        $searchBarContent = file_get_contents("gui/searchBar.html");
        $page = file_get_contents($this->templateFile);
        $page = $searchBar == null ? str_replace('%searchBar%', '', $page) : str_replace('%searchBar%', $searchBarContent, $page);
        $page = str_replace(['%title%', '%content%', '%username%'], [$title, $content, $username], $page);
        echo $page;
    }
}