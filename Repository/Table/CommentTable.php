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
    public function commentsOn(int $ticket) : array|bool
    {
        if(($record = $this->select($ticket))=== FALSE)
        {
            return FALSE;
        }
        return $record->getData();
    }
}