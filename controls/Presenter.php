<?php

namespace controls;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function showAllTickets()
    {
        $content = '';
        foreach ($this->outputData->getOutputData() as $post) {
            $content .= "
            <article>
            <header>
                <a href='/'>
                    <h1 class='titreBillet'>" . $post->getTitle() . "</h1>
                </a>
                <time>" . $post->getDate() . " ?></time>
            </header>
            <p> " . $post->getMessage() . "</p>
            </article>";
        }
        return $content;
    }
}