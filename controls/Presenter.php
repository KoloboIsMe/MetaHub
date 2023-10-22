<?php

namespace controls;

class Presenter
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function showCompleteTickets($id = 0, $showCategories = true)
    {
        $content = "
        <div class='card-container'>";
        isset($_GET['url']) && $_GET['url'] == "posts" && isset($_GET['id']) ? $isIDinURL = $_GET['id'] : $isIDinURL = 0;
        foreach ($this->outputData->getOutputDataTickets($id) as $ticket) {
            $id = $ticket->getTicket_ID();
            $user = $this->outputData->getOutputDataUsers($ticket->getAuthor());
            $content .= "
                <div class='card'>
                    <a href='posts&id=$id'>
                    <div class='card-content'>
                        <p>" . $user->getUsername() . "</p>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p>";

            $categories = '';
            if($showCategories) {
                foreach ($this->outputData->getOutputDataCategories($id) as $category) {
                    $categories .= '#' . $category->getLabel() . ' ';
                }
            }

            $content .= "
                    <p>". $categories ."</p>
                    ";

            if($isIDinURL){
                foreach ($this->outputData->getOutputDataComments($id) as $comment) {
                    $content .= "
                        <p>". $comment->getAuthor_username() . ' : '. $comment->getText() ."</p>
                        ";
                }
            }
            $content .= "       
                    </div></a>   
                </div>
                ";
        }
            $content .= "                  
            </div>";
            return $content;
    }

    public function showHomePage()
    {
        $content = '';
        foreach ($this->outputData->getOutputDataTickets() as $ticket) {
            $id = $ticket->getTicket_ID();
            $content .= $this->showCompleteTickets($id);
        }
        return $content;
    }

    public function showCategoriesTickets()
    {
        $content = "<div class='card-container'>";
        foreach ($this->outputData->getOutputDataCategories() as $category) {
            $id = $category->getCategory_ID();
            $content .= "<a href='categories&id=$id'><h1>" . $category->getLabel() . "</h1></a>";
            foreach ($this->outputData->getOutputDataTickets($id) as $ticket) {
                $id = $ticket->getTicket_ID();
                $user = $this->outputData->getOutputDataUsers($ticket->getAuthor());
                $content .= "
                <div class='card'>
                    <a href='posts&id=$id'>
                    <div class='card-content'>
                        <p>" . $user->getUsername() . "</p>
                        <h3> " . $ticket->getTitle() . "</h3>
                        <p>" . $ticket->getMessage() . "</p>
                        <time>" . $ticket->getDate() . " </time>
                        <p>" . $ticket->getTicket_ID() . "</p>
                    </div></a>
                </div>";
            }
        }
        $content .= "                  
        </div>";
        return $content;
    }



}