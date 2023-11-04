<?php

namespace Framework\Element;

class Card
{
    public function __construct(private string $author,
                                private string $title,
                                private string $message,
                                private string $date,
                                private string $id,
                                private array $categories,
                                private array $comments)
    {
    }
    public function __toString(): string
    {
        return "
        <div class='card'>
            <a href='posts&id=<?php echo $this->id ?>'>
            <div class='card-content'>
                <p>$this->username</p>
                <h3>$this->title </h3>
                <p>$this->message </p>
                <time>$this->date</time>
                <p>$this->id</p>
            </div>
            </a>
        </div>";
    }
}