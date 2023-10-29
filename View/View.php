<?php

namespace gui;
class View
{
    const HEADER = 'header.php';
    const FOOTER = 'footer.php';
    public function __construct(private $title, private $content)
    {

    }
    public function display()
    {
        include self::HEADER;
        echo $this->content;
        include self::FOOTER;
    }
}