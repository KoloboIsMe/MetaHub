<?php

class CategoryDatabase implements Database
{
    private $data;

    public function getData(){
        return $this->data;
    }
}