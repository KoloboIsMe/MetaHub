<?php

namespace service;

interface CommentInterface
{
    public function createComment($text,$date, $user_ID, $ticket_ID);

}
