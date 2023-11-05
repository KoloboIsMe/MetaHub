<?php
///////////////////////////////////////////////////////////////////////////////
/////////////////////////////  COMMENT TABLE  /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// The 'Comment' table singleton.
/// TO DO : Apply parameters verification to methods.
namespace Framework\Database\Table;

use Comment;

class CommentTable
{
    use BasicTable;
    use IdentifiedTable;
    const TABLE = 'comment';
    private function newEntity(array $data) : Comment
    {
        $ID = $data[0];
        $text = $data[1];
        $date = $data[2];
        $author = $data[3];
        $ticket = $data[4];
        return new Category($ID, $text, $date, $author, $ticket);
    }
    public function commentsOn(Ticket|int $ticket) : array|bool
    {
        $ticketId = is_int($ticket) ? $ticket : $ticket->getId();
        if(($record = $this->select($ticketId, 'ticket'))=== FALSE)
        {
            return FALSE;
        }
        return $record->getData();
    }
    public function commentsOf(User|int $author) : array|bool
    {
        $userId = is_int($author) ? $author : $author->getId();
        if(($record = $this->select($author, 'author'))=== FALSE)
        {
            return FALSE;
        }
        return $record->getData();
    }
}