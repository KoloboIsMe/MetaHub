<?php

class UserDatabase implements Database
{
    private $data;

    public function getData(){
        return $this->data;
    }
}