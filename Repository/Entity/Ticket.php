<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  TICKET  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Represents a single ticket.
/// TO DO : Give default values to constructor.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Entity;

class Ticket extends Entity
{
    use ID;
    private string $title;
    private string $message;
    private string $date;
    private int $author;
    static function ticket(int $ID, string $title, string $message, string $date, int $author) : Ticket
    {
        return new Ticket(array(
            'ID' => $ID,
            'title' => $title,
            'message' => $message,
            'date' => $date,
            'author' => $author
        ));
    }
    public function author() : User
    {
        global $userTable;

        if($record = $userTable->select($this->author) === FALSE)
        {
            return FALSE;
        }

        return $record->getData()[0];
    }
    public function categories() : array
    {
        global $categorizedTable, $categoryTable;

        if($categories = $categorizedTable->categoriesOf($this->getID()) === FALSE)
        {
            return FALSE;
        }

        return $categories;
    }
    static function post(string $title, string $message, int $author)
    {
        return new Ticket(array(
            'title' => $title,
            'message' => $message,
            'date' => date('Y-m-d H:i:s'),
            'author' => $author
        ));
    }
    public function setTitle(string $title) : Ticket
    {
        $this->title = $title;
        return $this;
    }
    public function setMessage($message) : Ticket
    {
        $this->message = $message;
        return $this;
    }
    public function setDate($date) : Ticket
    {
        $this->date = $date;
        return $this;
    }
    public function setAuthor($author) : Ticket
    {
        $this->author = $author;
        return $this;
    }
    public function getTitle() : string
    {
        return $this->title;
    }
    public function getMessage() : string
    {
        return $this->message;
    }
    public function getDate() : string
    {
        return $this->date;
    }
    public function getAuthor() : int
    {
        return $this->author;
    }
}