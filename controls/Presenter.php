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
        foreach ($this->outputData->getOutputData() as $ticket) {
            $content .= "
            <div class='card-container1'>
                <div class='card'>
                    <div class='card-content'>
                        <h3> ". $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p>
                    </div>
                   
                </div>";
        }
        $content .= "</div>";
        return $content;
    }
}