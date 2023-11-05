<?php

namespace services;

interface CommentInterface
{
    public function createComment($text, $date, $user_ID, $ticket_ID);
    public function isCommentOwner($commentID, $user_ID);

}
