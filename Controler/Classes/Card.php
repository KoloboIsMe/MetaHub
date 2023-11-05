<?php

namespace Controler\Element;

use Framework\Database\Entity\Ticket;

class Card
{
    private string $author;
    private string $title;
    private string $message;
    private string $date;
    private string $id;
    public function __construct(Ticket $ticket, private ?array $categories = null, private ?array $comments = null)
    {
        $ticket->author();
        $this->author = $ticket->author();
        $this->title = $ticket->getTitle();
        $this->message = $ticket->getMessage();
        $this->date = $ticket->getDate();
        $this->id = $ticket->getID();
    }
    private function showCategories()
    {
        if (empty($this->categories))
        {
            return;
        }
        $display = '';
        foreach ($this->categories as $category)
        {
            if (empty($this->category))
            {
                continue;
            }
            $display .= "<p> $category->getLabel() </p>";
        }
        return $display;
    }
    private function showComments()
    {
        if (empty($this->comments))
        {
            return;
        }
        $display = '';
        foreach ($this->comments as $comment)
        {
            if (empty($this->comment))
            {
                continue;
            }
            $display .= "<p> $comment->getText() </p>";
        }
        return $display;
    }
    public function __toString(): string
    {
        $categories = $this->showCategories();
        $comments = $this->showComments();
        return "
        <div class='card'>
            <a href='posts&id=<?php echo $this->id ?>'>
            <div class='card-content'>
                <p>$this->author</p>
                <h3>$this->title </h3>
                <p>$this->message </p>
                <time>$this->date</time>
                <p>$this->id</p>
                $categories;
                $comments;
            </div>
            </a>
        </div>";
    }
}