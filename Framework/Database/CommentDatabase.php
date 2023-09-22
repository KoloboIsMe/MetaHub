<?php

class CommentDatabase implements Database
{
    private $data;
    public function getData(){
        return $this->data;
    }
}