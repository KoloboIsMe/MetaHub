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
    public function __construct(Ticket $ticket, private array $categories, private array $comments)
    {
        $ticket->author();
        $this->author = $ticket->author();
        $this->title = $ticket['title'];
        $this->message = $ticket['message'];
        $this->date = $ticket['date'];
        $this->id = $ticket['id'];
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
        foreach ($this->categories as $category)
        {
            $display .= "<p> $category->getLabel() </p>";
        }
        return $display;
    }
    public function __toString(): string
    {
        return "
        <div class='card'>
            <a href='posts&id=<?php echo $this->id ?>'>
            <div class='card-content'>
                <p>$this->author</p>
                <h3>$this->title </h3>
                <p>$this->message </p>
                <time>$this->date</time>
                <p>$this->id</p>
                $this->showCategories()
                $this->showComments()
            </div>
            </a>
        </div>";
    }
}