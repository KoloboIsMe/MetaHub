<?php

class TicketDatabase implements Database
{
    private $data;

    public function getData(){
        return $this->data;
    }
}