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
        foreach ($this->outputData->getOutputDataTickets() as $ticket) {
            $id = $ticket->getTicket_ID();
            $content .= "
            <div class='card-container1'>
                <a href='posts&id=$id'>
                <div class='card'>
                    <div class='card-content'>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p></a>";

            foreach ($this->outputData->getOutputDataComments($id) as $comment) {
                if ($comment->getTicket() == $id)
                    $content .= "
                        <p>" . $comment->getText() . "</p>";
            }
                $user = $this->outputData->getOutputDataUser($ticket->getAuthor());
                $content .= "
                        <p>" . $user->getUsername() . "</p>
                    </div>
                </div>";
        }
            $content .= "
            </div>";
            return $content;
    }
}