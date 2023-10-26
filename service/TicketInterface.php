<?php

namespace service;

interface TicketInterface{

    public function getPostById($ticketid);
    public function getTicketsID();
    public function get5LastTicketsID();

}