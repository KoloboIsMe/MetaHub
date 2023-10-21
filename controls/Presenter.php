<?php

namespace controls;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function showCompleteTickets($id = 0)
    {
        $content = '';
        foreach ($this->outputData->getOutputDataTickets($id) as $ticket) {
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

            foreach ($this->outputData->getOutputDataCategories($id) as $category) {
                    $content .= "
                        <p>#" . $category->getLabel() . "</p>";
            }
                $user = $this->outputData->getOutputDataUsers($ticket->getAuthor());
                $content .= "
                        <p>" . $user->getUsername() . "</p>
                    </div>
                </div>";
        }
            $content .= "
            </div>";
            return $content;
    }

    public function showCategoriesTickets()
    {
        $content = '';
        foreach ($this->outputData->getOutputDataCategories() as $category) {
            $id = $category->getCategory_ID();
            $content .= "
            <div class='card-container1'>
                <a href='categories&id=$id'><h1>" . $category->getLabel() . "</h1></a>";
            foreach ($this->outputData->getOutputDataTickets($id) as $ticket) {
                $id = $ticket->getTicket_ID();
                $content .= "
                <div class='card'>
                    <div class='card-content'>
                        <h1>" . $category->getLabel() . "</h1>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p>";

                foreach ($this->outputData->getOutputDataComments($id) as $comment) {
                    if ($comment->getTicket() == $id)
                        $content .= "
                        <p>" . $comment->getText() . "</p>";
                }
                $user = $this->outputData->getOutputDataUsers($ticket->getAuthor());
                $content .= "
                        <p>" . $user->getUsername() . "</p>
                    </div>
                </div>";
            }
            $content .= "
            </div>";
        }
        return $content;
    }


}