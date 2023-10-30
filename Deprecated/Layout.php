<?php

namespace Deprecated;
class Layout
{
    private $templateFile;

    public function __construct($templateFile)
    {
        $this->templateFile = $templateFile;
    }

    public function display($title, $content, $username)
    {
        $page = file_get_contents($this->templateFile);
        $page = str_replace(['%title%', '%content%', '%username%'], [$title, $content, $username], $page);
        echo $page;
    }
}